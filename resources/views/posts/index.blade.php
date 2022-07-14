@extends('posts.masterpage')

@section('left')
    <h1>list of posts</h1>

    <ul>
        @forelse ($posts as $post)
            <li class="list-group-item m-1" style="background-color: rgb(229, 223, 215)">
                <span class="badge bg-secondary">Id: {{ $post->id }}</span><br>
                @if (!$post->deleted_at)
                    <a href="{{ route('posts.show', $post->id) }}">Title : {{ $post->title }}</a> <br>
                @else
                    <del>
                        Title : {{ $post->title }} <br>
                    </del>
                @endif
                <p>Content : {{ $post->content }}</p>
                <p class="text-muted">Created at {{ $post->created_at }} </p>
                <p class="text-muted">Updated at {{ $post->updated_at }} </p>
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
    <div class="card mt-5 ">
        <div class="card-body">
            <h4>Most Post Commented</h4>
            <ul class="list-group list-group-flush">
                @foreach ($MostPostCommented as $MPC)
                    <li class="list-group-item">
                        {{-- <p></p> --}}
                        * {{ $MPC->title }}
                        <span class="badge bg-secondary">{{ $MPC->comment_count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <h4>Most User Posted</h4>
            <ul class="list-group list-group-flush">
                @foreach ($MostUserPosted as $MUP)
                    <li class="list-group-item">
                        * {{ $MUP->name }}
                        <span class="badge bg-secondary">{{ $MUP->post_count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <h4>Users Active Last Month</h4>
            <ul class="list-group list-group-flush">
                @foreach ($UsersActiveLastMonth as $UALM)
                    <li class="list-group-item">
                        * {{ $UALM->name }}
                        <span class="badge bg-secondary">{{ $UALM->post_count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    
@endsection
