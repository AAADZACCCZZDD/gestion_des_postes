@extends('posts.masterpage')

@section('left')
    <h1>list of posts</h1>

    <ul>
        @forelse ($posts as $post)
            <li>
                {{ $post->id }}
                <a href="{{route('posts.show', $post->id)}}">{{ $post->title }}</a> <br>
                <button class="btn btn-warning"><a href=" {{route('posts.edit', ['post'=>$post->id])}} ">Edit</a> </button>
            </li>
            <form action=" {{route('posts.destroy', ['post'=>$post->id])}} " method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>

        @empty
            <p>no post exist</p>
        @endforelse
    </ul>
@endsection
