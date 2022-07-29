<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
</head>
<body>
    {{-- <h5><a href=" {{route('posts.show', [$post->id])}} "></a> Someone has just commented on you post</h5> --}}
    <h5> Someone has just commented on your post</h5>

    <p>
        commented by <a href=" {{route('users.show', ['user'=>$comment->user->id])}} "> {{$comment->user->name}} </a> said : "{{ $comment->content }}"
    </p>
</body>
</html>