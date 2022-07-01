<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function replies(){
        return $this->hasMany(Comment::class, 'comment_reply_id', 'id');
    }

    public function blog(){
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
}
