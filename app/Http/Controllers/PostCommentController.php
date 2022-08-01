<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\CommentPosted;
use Illuminate\Http\Request;
use App\Jobs\PostCommentedJob;
use App\Events\EventCommentPosted;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CommentRequest;
use App\Events\CommentPosted as EventsCommentPosted;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Post $post)
    {
        // dd($id);
        $comment =  $post->comment()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);
        // Mail::to($post->user->email)->send(new CommentPostedMarkdown($comment));
        // Mail::to($post->user->email)->send(new CommentPosted($comment));

        
         
        // $when = now()->addMinutes(1);
        // Mail::to($post->user->email)->later($when , new CommentPosted($comment));
        
        // PostCommentedJob::dispatch($comment);

        // Mail::to($post->user->email)->queue(new CommentPosted($comment));
        event(new EventCommentPosted($comment));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
