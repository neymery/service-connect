<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:messages')->only(['store']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Récupérer les conversations avec statistiques
        $conversations = $this->getConversationsWithStats($user);
        
        // Compter les messages non lus total
        $totalUnreadCount = $user->receivedMessages()->whereNull('read_at')->count();
        
        // Récupérer les messages récents pour l'aperçu
        $recentMessages = $user->receivedMessages()
            ->with(['sender'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('messages.index', compact('conversations', 'totalUnreadCount', 'recentMessages'));
    }

    private function getConversationsWithStats($user)
    {
        // Récupérer toutes les conversations avec statistiques détaillées
        $conversations = DB::select("
            SELECT 
                CASE 
                    WHEN sender_id = ? THEN receiver_id 
                    ELSE sender_id 
                END as other_user_id,
                MAX(created_at) as last_message_date,
                COUNT(*) as total_messages,
                SUM(CASE WHEN receiver_id = ? AND read_at IS NULL THEN 1 ELSE 0 END) as unread_count,
                (SELECT content FROM messages m2 
                 WHERE (m2.sender_id = ? AND m2.receiver_id = other_user_id) 
                    OR (m2.sender_id = other_user_id AND m2.receiver_id = ?)
                 ORDER BY m2.created_at DESC LIMIT 1) as last_message_content,
                (SELECT sender_id FROM messages m3 
                 WHERE (m3.sender_id = ? AND m3.receiver_id = other_user_id) 
                    OR (m3.sender_id = other_user_id AND m3.receiver_id = ?)
                 ORDER BY m3.created_at DESC LIMIT 1) as last_message_sender_id
            FROM messages 
            WHERE sender_id = ? OR receiver_id = ?
            GROUP BY other_user_id
            ORDER BY last_message_date DESC
        ", [$user->id, $user->id, $user->id, $user->id, $user->id, $user->id, $user->id, $user->id]);

        // Récupérer les informations des utilisateurs
        $userIds = collect($conversations)->pluck('other_user_id');
        $users = User::with(['profile'])->whereIn('id', $userIds)->get()->keyBy('id');

        return collect($conversations)->map(function($conversation) use ($users, $user) {
            $conversation->user = $users[$conversation->other_user_id] ?? null;
            $conversation->last_message_date = Carbon::parse($conversation->last_message_date);
            $conversation->is_last_message_mine = $conversation->last_message_sender_id == $user->id;
            return $conversation;
        });
    }

    public function conversation($userId)
    {
        $user = Auth::user();
        $otherUser = User::with(['profile'])->findOrFail($userId);
        
        // Vérifier que l'utilisateur a le droit de voir cette conversation
        $hasConversation = Message::where(function($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)->where('receiver_id', $userId);
        })->orWhere(function($query) use ($user, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $user->id);
        })->exists();

        // Récupérer tous les messages de la conversation avec pagination
        $messages = Message::where(function($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)->where('receiver_id', $userId);
        })->orWhere(function($query) use ($user, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $user->id);
        })
        ->with(['sender', 'receiver'])
        ->orderBy('created_at', 'desc')
        ->paginate(50);

        // Marquer les messages reçus comme lus
        $unreadMessages = Message::where('sender_id', $userId)
               ->where('receiver_id', $user->id)
               ->whereNull('read_at')
               ->get();

        foreach ($unreadMessages as $message) {
            $message->update(['read_at' => now()]);
        }

        // Statistiques de la conversation
        $stats = [
            'total_messages' => Message::where(function($query) use ($user, $userId) {
                $query->where('sender_id', $user->id)->where('receiver_id', $userId);
            })->orWhere(function($query) use ($user, $userId) {
                $query->where('sender_id', $userId)->where('receiver_id', $user->id);
            })->count(),
            'my_messages' => Message::where('sender_id', $user->id)->where('receiver_id', $userId)->count(),
            'their_messages' => Message::where('sender_id', $userId)->where('receiver_id', $user->id)->count(),
        ];

        return view('messages.conversation', compact('messages', 'otherUser', 'stats'));
    }

    public function create($receiverId = null)
    {
        $user = Auth::user();
        $receiver = null;
        
        if ($receiverId) {
            $receiver = User::with(['profile'])->findOrFail($receiverId);
            
            // Vérifier que le destinataire n'est pas l'utilisateur lui-même
            if ($receiver->id === $user->id) {
                return redirect()->route('messages.index')->with('error', 'Vous ne pouvez pas vous envoyer un message à vous-même.');
            }
        }
        
        // Récupérer les utilisateurs disponibles selon le rôle
        if ($user->isClient()) {
            // Pour les clients : récupérer les prestataires disponibles
            $availableUsers = User::where('role', 'prestataire')
                       ->with(['profile.category'])
                       ->join('provider_profiles', 'users.id', '=', 'provider_profiles.user_id')
                       ->where('provider_profiles.is_available', true)
                       ->select('users.*')
                       ->get();
        } else {
            // Pour les prestataires : récupérer tous les clients
            $availableUsers = User::where('role', 'client')
                       ->with(['profile'])
                       ->get();
        }
        
        return view('messages.create', compact('availableUsers', 'receiver'));
    }

    public function store(StoreMessageRequest $request)
    {
        $receiver = User::findOrFail($request->receiver_id);
        
        // Créer le message
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        // Si c'est une requête AJAX (pour la réponse rapide)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'content' => $message->content,
                    'created_at' => $message->created_at->format('d/m/Y H:i'),
                    'sender_name' => Auth::user()->name,
                    'is_mine' => true
                ]
            ]);
        }

        // Rediriger vers la conversation
        return redirect()->route('messages.conversation', $receiver->id)->with('success', 'Message envoyé avec succès');
    }

    public function markAsRead($id)
    {
        $message = Message::findOrFail($id);
        
        if ($message->receiver_id === Auth::id() && !$message->read_at) {
            $message->update(['read_at' => now()]);
            
            return response()->json([
                'success' => true,
                'read_at' => $message->read_at->format('d/m/Y H:i')
            ]);
        }
        
        return response()->json(['success' => false]);
    }

    public function markAllAsRead()
    {
        $count = Auth::user()->receivedMessages()->whereNull('read_at')->count();
        Auth::user()->receivedMessages()->whereNull('read_at')->update(['read_at' => now()]);
        
        return redirect()->back()->with('success', "{$count} message(s) marqué(s) comme lu(s)");
    }

    public function getUnreadCount()
    {
        $count = Auth::user()->receivedMessages()->whereNull('read_at')->count();
        return response()->json(['unread_count' => $count]);
    }

    public function searchUsers(Request $request)
    {
        $search = $request->get('q');
        $user = Auth::user();
        
        $query = User::where('id', '!=', $user->id);
        
        if ($user->isClient()) {
            $query->where('role', 'prestataire');
        } else {
            $query->where('role', 'client');
        }
        
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        
        $users = $query->with(['profile'])->limit(10)->get();
        
        return response()->json($users->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'photo' => $user->profile && $user->profile->photo ? asset('storage/' . $user->profile->photo) : null,
                'category' => $user->role === 'prestataire' && $user->profile ? $user->profile->category->name ?? null : null
            ];
        }));
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        
        // Seul l'expéditeur peut supprimer son message
        if ($message->sender_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Non autorisé'], 403);
        }
        
        $message->delete();
        
        return response()->json(['success' => true]);
    }
}
