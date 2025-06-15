<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false; 

    protected $fillable = [
        'email',
        'pass',
        'username',
        'avatar',
        'phone',
        'address',
        'uid',
        'token',
        'role',
    ];

    protected $hidden = [
        'pass',
        'token',
    ];
}
