<?php

namespace App\Listeners;

use App\Mail\CommentPosted;
use App\Events\EventCommentPosted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class listenerCommentPosted
{
    // /**
    //  * Create the event listener.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventCommentPosted $event)
    {
        Mail::to($event->comment->commentable->user->email)->queue(new CommentPosted($event->comment));
        // Mail::to('laouanemourad96@gmail.com')->queue(new CommentPosted($event->comment));
    }
}
