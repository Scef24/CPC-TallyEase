<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN ='admin';
    const ROLE_COMMITTEE ='committee';
    const ROLE_CO_COMMITTEE ='co_committee';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'id',
        'created_at','updated_at'
    ];

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }
    public function isCommittee(){
        return $this->role === self::ROLE_COMMITTEE;
    }
    public function isCoCommittee(){
        return $this->role === self::ROLE_CO_COMMITTEE;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
