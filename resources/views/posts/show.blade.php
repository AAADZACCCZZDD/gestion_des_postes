@extends('posts.masterpage')

@section('left')
    <span class="badge bg-secondary">Id: {{ $post->id }}</span><br>
    <a>Title : {{ $post->title }}</a> <br>
    <p>Content : {{ $post->content }}</p>
    @if ($post->active)
        <p>Post is <a style="color: #2eba58" href="">activated</a> </p>
    @else
        <p>Post is<a style="color:rgb(201, 108, 14)">deactivated </a> </p>
    @endif

    <button class="btn btn-warning" style="display: inline"><a
            href=" {{ route('posts.edit', ['post' => $post->id]) }} ">Edit</a> </button>
    <form style="display: inline" action=" {{ route('posts.destroy', ['post' => $post->id]) }} " method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
@endsection
