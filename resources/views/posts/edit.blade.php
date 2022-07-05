@extends('posts.masterpage')

@section('left')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', ['post'=>$post->id]) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{old('title', $post->title)}}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">content:</label>
            <input type="text" class="form-control" id="pwd" placeholder="Enter content" name="content" value="{{old('content', $post->content)}}">
        </div>
        <button type="submit" class="btn btn-primary">Edit post</button>
    </form>
@endsection