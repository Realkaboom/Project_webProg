<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'nomorhp',
        'isAdmin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'isAdmin' => 'boolean',
    ];

    public function requests()
    {
        return $this->hasMany(RequestData::class, 'user_id');
    }

    public function requestLogs()
    {
        return $this->hasMany(RequestLog::class, 'user_id');
    }
}
