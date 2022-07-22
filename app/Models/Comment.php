<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Scopes\LatestScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function post()
    {
        return $this->belongsTo(Post::class);
    } 

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    protected $fillable = [
        'content',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        // static::creating(function(Comment $comment){
        //     Cache::forget("comment-{id}");
        // });
    } 

    // public function scopeDernier(Builder $builder)
    // {
    //     return $builder->orderBy(static::UPDATED_AT, 'asc');
    // }

    // public static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope(new LatestScope);        
    // }
}


