<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>UD9 Pt1 - @yield('title')</title>
        @section('stylesheets')
	<link rel="stylesheet" href="{{ asset('css/tabla.css') }}" />
        @show
    </head>
    <body>
        @include('navbar')

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>