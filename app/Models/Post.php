<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function comment()
    {
        return $this->hasMany(Comment::class);
    } 

    public static function boot()
    {
        parent::boot();

        static::deleting(function(Post $post){
            $post->comment()->delete();
        });

        static::restoring(function(Post $post){
            $post->comment()->restore();
        });
    }
}
