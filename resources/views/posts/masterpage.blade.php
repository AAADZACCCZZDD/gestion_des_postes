<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>laravel with github</title>
    <style>
        body {
            background-color: rgb(210, 207, 207);

        }

        a {
            display: inline-block;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand mx-5" href="#">Laravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mx-5">
                <li class="nav-item active">
                    <a class="nav-link mx-2" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="{{ route('posts.index') }}">index</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href=" {{ route('posts.create') }} ">create</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->email }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-8 m-auto text-center">
                @if (session()->has('create'))
                    <div class="alert alert-success" role="alert">
                        {{ session('create') }}
                    </div>
                @endif
                @if (session()->has('update'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('update') }}
                    </div>
                @endif
                @if (session()->has('delete'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('delete') }}
                    </div>
                @endif
                @if (session()->has('restore'))
                    <div class="alert alert-secondary" role="alert">
                        {{ session('restore') }}
                    </div>
                @endif
                @if (session()->has('forcedelete'))
                    <div class="alert alert-dark" role="alert">
                        {{ session('forcedelete') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                @yield('left')
            </div>
            <div class="col-4">
                @yield('right')
            </div>
        </div>
    </div>
</body>

</html>
