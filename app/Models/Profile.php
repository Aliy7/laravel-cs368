<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable =[
        'bio',
        'avatar',
        'phone_number',
        'bio',
        'date_of_birth',
        'website_link',
        'location'

    ];

    public function user(){
        retunr $this->belongsTo(User::class);
    }
}