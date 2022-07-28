@extends('posts.masterpage')

@section('left')
    <span class="badge bg-secondary">Id: {{ $post->id }}</span><br>
    <a>Title : {{ $post->title }}</a> <br>
    <p>Content : {{ $post->content }}</p>
    <div>
        @if ($post->image)
            <img src="{{ $post->image->url() }}" class="img-fluid rounded" alt="" width="70%"> <br>
        @endif
    </div>
    <br>
    @can('update', $post)
        <button class="btn btn-warning" style="display: inline"><a
                href=" {{ route('posts.edit', ['post' => $post->id]) }} ">Edit</a> </button>
    @endcan
    @can('delete', $post)
        <form style="display: inline" action=" {{ route('posts.destroy', ['post' => $post->id]) }} " method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    @endcan
    @if ($post->active)
        <p>Post is <a style="color: #2eba58" href="">activated</a> </p>
    @else
        <p>Post is<a style="color:rgb(201, 108, 14)">deactivated </a> </p>
    @endif

    @if ($post->comment_count === 0)
        <p>no comment exist</p>
    @elseif($post->comment_count === 1)
        <p>{{ $post->comment_count }} comment</p>
    @elseif($post->comment_count >= 1)
        <p>{{ $post->comment_count }} comments</p>
    @endif

    @auth
        <h1>Add Comment</h1>
        {{-- @include('posts.comment', ['id' => $post->id]) --}}
        <x-CommentForm :action="route('post.comment.store', ['post' => $post->id])"></x-CommentForm>
        {{-- @include('posts.comment') --}}
        {{-- @include('posts.comment', ['id' => $post->id]) --}}
    @endauth
    <ul>
        @forelse($post->comment as $com)
            <li>
                <p>{{ $com->content }}</p>
                <p class="text-muted">Created at {{ $com->created_at }} </p>
                <p class="text-muted">created at {{ $com->created_at }} By {{ $com->user->name }} </p>
            </li>
        @empty
            <p>no comment exist</p>
        @endforelse
    </ul>
@endsection


@section('right')
    @include('posts.sidebare')
@endsection
