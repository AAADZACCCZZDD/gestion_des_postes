@extends('posts.masterpage')

@section('left')
    <h1>list of posts</h1>

    <ul>
        @forelse ($posts as $post)
            <li class="list-group-item m-1" style="background-color: rgb(229, 223, 215)">
                <span class="badge bg-secondary">Id: {{ $post->id }}</span><br>
                @if (!$post->deleted_at)
                    <a href="{{ route('posts.show', $post->id) }}">Title : {{ $post->title }}</a> <br>
                    <p>Content : {{ $post->content }}</p>

                    <x-tags :tags="$post->tag"></x-tags>

                    <p class="text-muted">Created at {{ $post->created_at }}, By <a href=" {{route('users.show', [$post->user->id])}} ">{{ $post->user->name }} </a> </p>
                    <p class="text-muted">Updated at {{ $post->updated_at }} </p>
                    <div>
                        @if ($post->image)
                            <img src="{{ $post->image->url() }}" class="img-fluid rounded" alt="" width="100%"> <br>
                        @endif
                    </div>
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
                @else
                    <del>
                        Title : {{ $post->title }} <br>
                    </del>
                    <p class="text-muted">Deleted at {{ $post->deleted_at }} </p>
                @endif

                @if (!$post->deleted_at)
                    @can('update', $post)
                        <button class="btn btn-warning" style="display: inline"><a
                                href=" {{ route('posts.edit', ['post' => $post->id]) }} ">Edit</a> </button>
                    @endcan
                    @can('delete', $post)
                        <form style="display: inline" action=" {{ route('posts.destroy', ['post' => $post->id]) }} "
                            method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    @endcan
                    @cannot('update', $post)
                        <span class="badge badge-info badge-light">You can't update this post</span><br>
                    @endcannot
                    @cannot('delete', $post)
                        <span class="badge badge-info badge-light">You can't delete this post</span>
                    @endcannot
                @else
                    @can('restore', $post)
                        <form action="{{ url('/posts/' . $post->id . '/restore') }} " method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-warning" style="display: inline">restore</button>
                        </form>
                    @endcan
                    @can('forcedelete', $post)
                        <form action="{{ url('/posts/' . $post->id . '/forcedelete') }} " method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-dark mt-2">Outright delete</button>
                        </form>
                    @endcan
                @endif
            </li>
        @empty
            <p>no post exist</p>
        @endforelse
    </ul>
@endsection

@section('right')
    @include('posts.sidebare')
@endsection
