<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    use HasFactory;

    protected $user_post =[
        'post_id',
        'post_content',
        'image_url',
        'post_date',
        'post_time'


    ];

    public function user(){
        return $this -> belongsTo('App\User');
    }
    function category(){
        return $this->belongsTo(Category::class);
    }
}
