<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public function post()
    {
        // return $this->belongsToMany(Post::class)->withTimestamps();
        return $this->morphedByMany(Post::class, 'taggable')->withTimestamps();
    }
    public function comment()
    {
        return $this->morphedByMany(Comment::class, 'taggable')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
