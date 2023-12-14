<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pass_word',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * User's relationship with Post.
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    /**
     * User's relationship with Like.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * User's relationship with Profile.
     *
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * User's relationship with Role.
     */
   

    /**
     * Check if user has a specific role.
     *
     * @param array|string $roles
     * @return bool
     */
    // public function hasRole($roles)
    // {
    //     foreach ($roles as $role) {
    //         if ($this->roles->contains('name', $role)) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    public function showProfile($id)
{
    $user = User::with('posts')->findOrFail($id); // Assuming you have a posts relationship in your User model
    return view('users.profile', compact('user'));
}
}
