<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'content',
        
      

    ];

    public $guarded =[
        'category_id' ,  'user_id',
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

    // protected static function boot()
    // {
    //     parent::boot();

    //     // Automatically set post_date and post_time before creating a new Post
    //     // static::creating(function ($post) {
    //     //     $now = Carbon::now();
    //     //     $post->post_date = $now->toDateString();  // Date in Y-m-d format
    //     //     $post->post_time = $now->toTimeString();  // Time in H:i:s format
    //     // });
    //   }

}
