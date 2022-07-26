<?php
// namespace App\Scope;
namespace App\Models;


use App\Models\Tag;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Scopes\LatestScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function comment()
    {
        return $this->hasMany(Comment::class)->dernier();
    } 

    public function scopeMostPostCommented(Builder $builder)
    {
        return $builder->withCount('comment')->orderBy('comment_count', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function scopePostWithUserCommentTag(Builder $builder)
    {
        return $builder->with(['comment','user','comment.user','tag'])->withCount('comment');
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LatestScope);

        static::deleting(function(Post $post){
            $post->comment()->delete();
        });

        static::restoring(function(Post $post){
            $post->comment()->restore();
        });

        static::creating(function(Post $post){
            Cache::forget('posts');
        });
        static::updating(function(Post $post){
            Cache::forget('posts');
        });
        static::deleting(function(Post $post){
            Cache::forget('posts');
        });
    }
}
