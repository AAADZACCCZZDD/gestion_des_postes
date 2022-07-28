@extends('posts.masterpage')

@section('left')
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="Post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div>
                <h5>select a defference picture</h5><br>
                <img src=" {{ $user->image ? $user->image->url() : '' }} " alt="" class="img-thumbnail" width="100px">
                <input type="file" name="picture" id="picture" class="form-control-file">
            </div>
            <div class="my-3">
                <div class="form-group">
                    <label for="name">User</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {{-- @include('posts.errors') --}}
    </form>

    {{-- @include('posts.comment', ['id' => $user->id]) --}}
    
@endsection
