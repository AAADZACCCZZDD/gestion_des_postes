{{-- @foreach ($tags as $tag)
    <span class="badge badge-success"><a href=" {{ route('posts.tag.index', ['id' => $tag->id]) }} ">{{ $tag->name }}</a>
    </span>
@endforeach --}}


  
@foreach($tags as $tag)
<span class="badge badge-success"><a href="{{ route('posts.tag.index', ['id' => 3]) }}">{{ $tag->name }}</a></span>
    @endforeach