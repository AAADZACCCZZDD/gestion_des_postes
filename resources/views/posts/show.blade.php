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


    <ul>
        @forelse($comments as $comment)
            <li>
                <p>{{ $comment->content }}</p>
                {{-- <p class="text-muted">Created at {{ $comment->created_at }} </p> --}}
                <p class="text-muted">Updated at {{ $comment->updated_at }} </p>
            </li>
        @empty
            <p>no comment exist</p>
        @endforelse
    </ul>
@endsection
