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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $primaryKey = 'userID';
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'mobileNumber',
        'role',
        'password',
        'isVerified',
        'terms_accepted',
        'isActive',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the value of the "remember me" token for the user.
     *
     * @return string|null
     */

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the value of the "remember me" token for the user.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the name of the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'isVerified' => 'boolean',
    ];
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'renterID');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'userID');
    }
}
