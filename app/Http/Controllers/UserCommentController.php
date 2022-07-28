<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(CommentRequest $request, User $user)
    {
        $user->comment()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);
        return redirect()->back();
    }
}