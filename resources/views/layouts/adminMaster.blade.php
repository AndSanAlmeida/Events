<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>@yield('title') | {{ config('app.name') }}</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="all,follow">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- Styles --}}
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}" id="theme-stylesheet">

    </head>
    <body >
        
        <div id="admin" class="page">
            @yield('content')
        </div>

        @yield('pagescript') 

    </body>
</html> 

    