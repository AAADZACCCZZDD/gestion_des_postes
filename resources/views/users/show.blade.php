@extends('posts.masterpage')

@section('left')
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  mr-auto">
            <h5>Avatar user</h5>
            <img src=" {{ $user->image ? $user->image->url() : '' }} " alt="" class="img-thumbnail avataaar">
            @can('update', $user)
                <button class="btn btn-warning"> <a href="{{ route('users.edit', $user->id) }}">edit</a>
                </button>
            @endcan
        </div>
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12  mr-auto">
            <h3> {{ $user->name }} </h3>
            <h5 class="mt-4">add comment</h5>
            <x-CommentForm :action="route('users.comment.store', ['user' => $user->id])"></x-CommentForm>

            <ul>
                @forelse($user->comment as $com)
                    <li>
                        <p>{{ $com->content }}</p>
                        <p class="text-muted">created at {{ $com->created_at }} By {{ $com->user->name }} </p>
                    </li>
                @empty
                    <p>no comment exist</p>
                @endforelse
            </ul>

        </div>

        

    </div>
@endsection
