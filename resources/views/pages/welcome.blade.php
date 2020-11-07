<!doctype html>
<html lang="en">
@include('includes.head')
<body>
<div id="app">

    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/') }}">Welcome</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        @section( 'goodmorning' )

                <div class="container">
            <!--<img id="image" src="{{URL::asset('/images/map.png')}}" alt="map?">-->
                @include('includes.title')
                <!--<h1><a href="http://192.168.10.10/">Werble</a></h1>-->
                <p id="hello">Welcome to your comfort zone!</p>
                </div>
            @show

            @section('buttons')
            <a href="{{route('login.web')}}" ><button>Login</button></a>
            <a href="{{route('signup.web')}}" ><button>Signup</button></a>
            @show

</div>
</div>
<script src="./js/app.js"></script>
</body>
</html>
