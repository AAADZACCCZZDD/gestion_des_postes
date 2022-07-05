@extends('posts.masterpage')

@section('left')
    <h1>Add Post</h1>

    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">content:</label>
            <input type="text" class="form-control" id="pwd" placeholder="Enter content" name="content">
        </div>
        <button type="submit" class="btn btn-primary">Add post</button>
    </form>
@endsection