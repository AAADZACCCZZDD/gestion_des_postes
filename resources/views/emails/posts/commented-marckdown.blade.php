@component('mail::message')
    ## Hi, **{{ $comment->user->name }}** has just commented on your post!


    {{-- @component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
Show user
@endcomponent --}}

    @component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
        Show comment
    @endcomponent
{{-- 
    @component('mail::panel')
        {{ $comment->content }}
    @endcomponent --}}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
