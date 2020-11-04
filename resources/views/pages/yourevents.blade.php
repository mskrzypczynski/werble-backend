<!DOCTYPE html>
<html>
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/title.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/yourevents.css') }}" rel="stylesheet" type="text/css">

<body>

@include('layouts.sidebar')

<!-- Page Content -->
<div style="margin-left:25%">

    <div class="w3-container">
        <div id="oneevent">
            <div class="mainDiv" style="width:90%">
                <div id="borderLeft">
                    <table>
                <tr>
                    <th>ID</th>
                    <th>{{$event->event_id}}</th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>{{$event->name}}</th>
                </tr>   <tr>
                    <th rowspan="4">Location</th>
                    <th>{{$event->location}}</th>
                <tr>
                    <th>{{$event->zip_code}}</th>
                </tr>
                <tr>
                    <th>{{$event->street_name}}</th>
                </tr>
                <tr>
                    <th>{{$event->house_number}}</th>
                </tr>
                <tr>
                    <th>Description</th>
                    <th>{{$event->description}}</th>
                </tr>
                <tr>
                    <th>Datetime</th>
                    <th>{{$event->datetime}}</th>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>{{$event->is_active}}</th>
                </tr>
                <tr>
                    <th>Creator</th>
                    <th>{{$event->event_creator_id}}</th>
                </tr>
                <tr>
                    <th>Type</th>
                    <th>{{$event->event_type_id}}</th>
                </tr>
            </table>
        </div>

    </div>

</div>

</body>
</html>
