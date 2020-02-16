<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <title>@yield('title') | {{ config('app.name') }}</title>
        
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		{{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Styles --}}
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('vendor/public/owlcarousel/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('vendor/public/lightcase/lightcase.css') }}">

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400|Work+Sans:300,400,700" rel="stylesheet">

		<!-- Custom fonts for this template-->
		<link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">

		<!-- Custom styles for this template-->
		<link href="{{ asset('css/public.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

		<!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

	</head> 
	{{-- <body data-spy="scroll" data-target="#navbar-nav-header" class="static-layout" style="background-image: url('{{ asset('img/bg.jpg') }}');"> --}}
	<body data-spy="scroll" data-target="#navbar-nav-header" class="static-layout">

		<div id="public">
            @yield('content')
        </div>

        @yield('pagescript') 

	</body>
</html>