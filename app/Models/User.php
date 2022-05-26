<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role',
        'user_avatar',
        'user_profession',
        'company_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions()
    {
        $this->hasMany(Question::class);
    }

    public function SetSessionData() 
    {
        session([
            'user_id' => $this->id,
            'user_name' => $this->name,
            'user_email' => $this->email,
            'user_role' => $this->user_role,
            'user_avatar' => $this->user_avatar,
            'user_profession' => $this->user_profession,
            'company_id' => $this->company_id
        ]);
    }
}
