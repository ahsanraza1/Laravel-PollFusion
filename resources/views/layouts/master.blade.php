<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>POLL FUSION @yield('title')</title>
</head>
<body>
    <header>
    @section('header')
        <nav class="navbar navbar-expand-sm bg-light fixed-top">
            <div class="container-fluid">
                <!-- <div class=""> -->
                <a class="navbar-brand" href="{{ url('/') }}">Poll Fusion</a>

                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navtop">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navtop">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/polls') }}?q=m">My Polls</a></li>

                        @if (Route::has('login'))
                                    @auth
                                    <li class="nav-item"><a  class="nav-link" href="{{ url('/poll/create') }}" class="">Create Poll</a></li>
                                @else
                                    <!-- <a href="{{ route('login') }}" class="">Log in</a> -->

                                    @if (Route::has('register'))
                                        <!-- <a href="{{ route('register') }}" class="">Register</a> -->
                                    @endif
                                @endauth
                            
                        @endif
                    </ul>

                    <ul class="navbar-nav navbar-right">
                        @if (Route::has('login'))
                                    @auth
                                    <!-- <li class="nav-item">
                                        <a  class="nav-link" href="{{ url('/dashboard') }}" class="">Dashboard</a>
                                    </li> -->

                                    <li class="dropdown nav-item">
                                        <span class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ Auth::user()->name }}
                                        </span>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item">
                                                <a href="{{ route('profile.edit')}}">
                                                    {{ __('Profile') }}
                                                </a>

                                            </li>
                                            <li class="dropdown-item">
                                                <!-- Authentication -->
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf

                                                    <a href="route('logout')"
                                                            onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                <!-- {{ Auth::user()->email }} -->

                

                
          


                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}" class="">Log in</a>
                                    </li>

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}" class="">Register</a>
                                        </li>
                                    @endif
                                @endauth
                            
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
    @show
    </header>
    <main>
        @yield('content')
    </main>
    <!-- <footer> -->
        <div class="container border mt-5"></div>
        <div class="container-fluid justify-content-center mt-4 p-3 bg-secondary border border-rounded-1 fixed-bottom" style="background-color:#f8f9fa">
            <!-- <div class="row bg-red justify-content-center border">
                <div class="justify-content-center col-2 border">
                    <a href="{{url('/')}}">POLL FUSION</a>
                </div>
            </div> -->
        </div>
    <!-- </footer> -->
</body>
</html>