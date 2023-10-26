<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model

{
    use HasFactory;

    protected $fillable=[
        'id',
        'comment_content',
        'date',
        'time',
        'feedback'
    ];

    public function user(){
        return $this -> belongsTo('App\User');
    }
}