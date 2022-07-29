<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentPosted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $objet = "Comment post for ". $this->comment->commentable->title ;

        return $this
        ->subject($objet)
        // ->attachFromStorageDisk('public', $this->comment->user->image->picture, 'Profile_picture.jpeg')
        // ->attachFromStorageDisk('public', $this->comment->user->image->picture ?? '')
        ->view('emails.posts.comment');
    }
}
