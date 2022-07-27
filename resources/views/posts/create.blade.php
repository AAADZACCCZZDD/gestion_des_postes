@extends('posts.masterpage')

@section('left')
    <h1>Add Post</h1>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"  value="{{old('title')}}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">content:</label>
            <input type="text" class="form-control" id="pwd" placeholder="Enter content" name="content"  value="{{old('content')}}">
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">picture:</label><br>
            <input type="file" class="form-control-file" id="picture" placeholder="choose the picture" name="picture" value="{{old('picture')}}">
        </div>
        <button type="submit" class="btn btn-primary">Add post</button>

        @include('posts.errors')

    </form>
@endsection
