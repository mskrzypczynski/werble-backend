<!DOCTYPE html>
<html>
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/title.css') }}" rel="stylesheet" type="text/css">
<body>

@include('layouts.sidebar')

<!-- Page Content -->
<div style="margin-left:25%">

    <div class="w3-container">
        <h2>MAP</h2>
    {{Session::get('accessToken')}}
    <?php

        ?>
    </div>

</div>

</body>
</html>
