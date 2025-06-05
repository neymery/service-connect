<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 'client' ou 'prestataire'
        'phone',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        if ($this->role === 'prestataire') {
            return $this->hasOne(ProviderProfile::class);
        }
        return $this->hasOne(ClientProfile::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'client_id');
    }

    public function receivedRatings()
    {
        return $this->hasMany(Rating::class, 'provider_id');
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isProvider()
    {
        return $this->role === 'prestataire';
    }


}
