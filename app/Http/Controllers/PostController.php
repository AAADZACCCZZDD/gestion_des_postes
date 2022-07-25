<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\PostCreateRequest;
use Illuminate\Support\Facades\Storage;

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
        $posts=Cache::remember('posts', now()->addSeconds(10), function(){
            return Post::withTrashed()->postWithUserCommentTag()->get();
        });
                
        return view('posts.index'
        ,[
            'posts'=>$posts,
        ]
    );
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
        
        $has_picture = $request->hasFile('picture');
        if($has_picture){
            $file = $request->file('picture');
            // dump($file->getClientOriginalExtension());
            // dump($file->getClientMimeType());
            // dump($file->getClientOriginalName());

            // $file->store('my_files');
            // dump(Storage::putFile('my_files', $file));
            // dump(Storage::disk('local')->putFile('my_files_local', $file));
            // dump($file->storeAs('my_files', random_int(1, 100). '.' .  $file->getClientOriginalName()));
            // dump($file->storeAs('my_files', random_int(1, 100). '.' .  $file->guessExtension()));
            // dump(Storage::putFileAs('my_files',$file, random_int(1, 100). '.' .  $file->getClientOriginalName()));
            // dump(Storage::disk('local')->putFileAs('my_files',$file, random_int(1, 100). '.' .  $file->guessExtension()));

            // $name1 = dump(Storage::putFileAs('my_files',$file, random_int(1, 100). '.' .  $file->getClientOriginalName()));
            $name3 = dump($file->storeAs('my_files', random_int(1, 100). '.' .  $file->getClientOriginalName()));
            // $name2 = dump(Storage::disk('local')->putFileAs('my_files',$file, random_int(1, 100). '.' .  $file->guessExtension()));
            dump(Storage::url($name3));
            // dump(Storage::disk('local')->url($name2));
        }
        dd('ok');
        
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
        $post=Cache::remember('post', now()->addSeconds(10), function() use ($id) {
            return Post::postWithUserCommentTag()->findOrFail($id); // method iger
        });
        return view('posts.show',[
            'post'=>$post,
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
