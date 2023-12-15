<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'is_read'];
    protected $guarded = ['user_id', 'post_id'];

    protected $casts = [
        'is_read' => 'boolean', // Cast is_read to boolean
    ];

    protected $with = ['post'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    public function isRead()
    {
        return $this->is_read;
    }
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

public function reactedPerson()
{
    if ($this->type == 'comment') {
        $comment = Comment::where('post_id', $this->post_id)->latest()->first();
        return $comment ? $comment->user->username : 'Unknown User';

    }

    return null;
}

}
