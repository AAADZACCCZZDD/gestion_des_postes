<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['picture'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function url()
    {
        return Storage::url($this->picture);
    }
}
