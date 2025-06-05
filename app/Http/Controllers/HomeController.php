<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        
        if ($user->isProvider()) {
            return view('home.provider', compact('user', 'categories'));
        } else {
            return view('home.client', compact('user', 'categories'));
        }
    }
}
