@extends('posts.masterpage')

@section('left')
    <form action="{{route('users.update', ['user'=>$user->id  ])}}" method="Post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div >
                <h5>select a defference avatar</h5><br>
                <img src="" alt="" class="img-thumbnail">
                <input type="file" name="avatar" id="avatar" class="form-control-file">
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
    </form>
@endsection