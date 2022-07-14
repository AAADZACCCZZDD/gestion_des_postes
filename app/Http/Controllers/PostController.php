<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostCreateRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::withTrashed()->withCount('comment')->get();
        $MostPostCommented=Post::MostPostCommented()->take(5)->get();
        $MostUserPosted=User::MostUserPosted()->take(5)->get();
        return view('posts.index',[
            'posts'=>$posts,
            'MostPostCommented'=>$MostPostCommented,
            'MostUserPosted'=>$MostUserPosted,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $post=new Post();
        $this->authorize('create', $post);
        $post->user_id = $request->user()->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = "-";
        $post->active = true;
        $post->save();
        $request->session()->flash('create','The post was created successfully');
        return redirect()->route('posts.show', ['post'=> $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show',[
            'post'=>Post::findOrFail($id),
            'comments'=>DB::table('comments')->where('post_id', '=', $id)->orderBy('updated_at', 'asc')->get(),
            // 'comments'=>DB::table('comments')->where('post_id', '=', $id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit',[
            'post'=>Post::findOrFail($id)
        ]);
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
        $post=Post::findOrFail($id);
        $this->authorize('update', $post);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = "-";
        $post->active = true;
        $post->save();
        $request->session()->flash('update','The post was updated successfully');
        return redirect()->route('posts.show', ['post'=> $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $post=Post::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('delete','The post was deleted successfully');
        return redirect()->route('posts.index');
    }

    public function restore(Request $request, $id){
        $post=Post::onlyTrashed()->where('id', $id)->first();
        $this->authorize('restore', $post);
        $post->restore();
        $request->session()->flash('restore','The post was restored successfully');
        return redirect()->route('posts.index');
    }

    public function forcedelete(Request $request, $id){
        $post=Post::onlyTrashed()->where('id', $id)->first();
        $this->authorize('forcedelete', $post);
        $post->forceDelete();
        $request->session()->flash('forcedelete','The post was outright delete successfully');
        return redirect()->route('posts.index');
    }

    
}
