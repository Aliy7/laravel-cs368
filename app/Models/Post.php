<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'category_id',
        'post_content',
        'image_url',
        'post_date',
        'post_time',
        'user_id',
        'category_id',

    ];
    public function user(){
        return $this -> belongsTo(User::class);
    }
    function category(){
        return $this->belongsTo(Category::class);
    }
   
    public function likes(){
        return $this -> hasMany(Like::class);
    }
    public function comments(){
        return $this -> hasMany(Comment :: class);
    }
}
