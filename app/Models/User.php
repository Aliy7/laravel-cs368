<?php

namespace App\Models;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
    protected $fillable = [
        'user_name',
        'email',
        'first_name',
        'password',
        'Last_name',
        'date_of_Birth',
        'city',
        'postcode',
        'country',
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

    public function post(){
        return $this -> belongsTo(Post::class);
    }

    public function likes(){
        return $this -> hasMany(Like::class);
    }

    public function profile(): HasOne{
        return $this -> hasOne(Profile::class);
    }
    
    protected static function booted(){
    static::creating(function ($user) {
        Log::info('User is being created', ['user' => $user->toArray()]);
     });
}

}
