<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [

        'name',
        'location',
        'gender',
        'interested_in',
        'email',
        'password',
        'age',
        'bio',
        'picture',
        'visible'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Favoriting
    public function favoriting(){

        return $this->belongsToMany(User::class, "user_favoriting", "favorited_id", "favoriting_id");
        
    }
    
    public function favorited(){
        
        return $this->belongsToMany(User::class, "user_favoriting", "favoriting_id", "favorited_id");

    }


    // Blocking
    public function blocking(){

        return $this->belongsToMany(User::class, "user_blocking", "blocked_id", "blocking_id");

    }
    
    public function blocked(){

        return $this->belongsToMany(User::class, "user_blocking", "blocking_id", "blocked_id");

    }


    // Messaging
    public function sendingMessage(){

        return $this->belongsToMany(User::class, "user_messaging", "receiver_id", "sender_id");

    }
    
    public function receivingMessage(){

        return $this->belongsToMany(User::class, "user_messaging", "sender_id", "receiver_id");
        
    }

    
    // JWT
    public function getJWTIdentifier(){

        return $this->getKey();

    }

    public function getJWTCustomClaims(){

        return [];

    }
    
}
