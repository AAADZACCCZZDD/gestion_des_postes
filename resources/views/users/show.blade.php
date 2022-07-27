@extends('posts.masterpage')

@section('left')
<div class="row">
    <div class="col-md-4">
        <h5>Avatar user</h5>
        <img src=" {{$user->image ? $user->image->url() : ''}} " alt="" class="img-thumbnail avataaar">
        @can('update', $user)
            <button class="btn btn-warning"> <a href="{{ route('users.edit', $user->id) }}">edit</a>
            </button>
        @endcan
    </div>
    <div class="col-md-8">
        <h3> {{ $user->name }} </h3>
    </div>
</div>
@endsection