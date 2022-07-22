<form action="{{ route('post.comment.store', ['post'=>$id]) }}" method="post">
    @csrf
    <div class="mb-3 mt-3">
        <textarea name="content" id="content" cols="80" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red">
                        {{$error}} 
                    </li>
                @endforeach
            </ul>
        @endif
