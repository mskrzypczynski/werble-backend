<!DOCTYPE html>
<html>
<title>@yield('title')</title>
@include('includes.head')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/title.css') }}" rel="stylesheet" type="text/css">
<body>

@include('layouts.sidebar')

<!-- Page Content -->
<div style="margin-left:25%">

    <div class="w3-container">
        <?php
        dd($user->login);
        ?>
        @auth
        <h2>{{ Auth::guard('api')->user()->login }} </h2>
>        @endauth

    </div>

</div>

</body>
</html>
