<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[ 'title','content','image_url'];

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


}
