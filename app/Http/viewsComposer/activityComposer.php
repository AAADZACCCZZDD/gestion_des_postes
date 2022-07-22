<?php

namespace App\Http\viewsComposer;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;


class ActivityComposer
{
    public function compose(View $view)
    {
        // $posts = Cache::remember('posts', now()->addSeconds(10), function () {
        //     return Post::withTrashed()->withCount('comment')->with(['user', 'tag', 'comment'])->get();
        // });
        $MostPostCommented = Cache::remember('MostPostCommented', now()->addSeconds(10), function () {
            return Post::MostPostCommented()->take(5)->get();
        });
        $MostUserPosted = Cache::remember('MostUserPosted', now()->addSeconds(10), function () {
            return User::MostUserPosted()->take(5)->get();
        });
        $UsersActiveLastMonth = Cache::remember('UsersActiveLastMonth', now()->addSeconds(10), function () {
            return User::UsersActiveLastMonth()->take(5)->get();
        });
        

        $view->with([
            // 'posts' => $posts,
            'MostPostCommented' => $MostPostCommented,
            'MostUserPosted' => $MostUserPosted,
            'UsersActiveLastMonth' => $UsersActiveLastMonth
        ]);
    }
}
