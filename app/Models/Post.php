<?php
// namespace App\Scope;
namespace App\Models;


use App\Models\Comment;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function comment()
    {
        // return $this->hasMany(Comment::class)->dernier();
        return $this->hasMany(Comment::class);
    } 

    public function scopeMostPostCommented(Builder $builder)
    {
        return $builder->withCount('comment')->orderBy('comment_count', 'desc');
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
    }
}
