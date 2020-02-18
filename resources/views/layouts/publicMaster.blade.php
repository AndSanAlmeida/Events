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
		<link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">

		<!-- Custom styles for this template-->
		<link href="{{ asset('css/public.css') }}" rel="stylesheet">

	</head> 
	<body>
		<div id="overlayer"></div>
		<div class="loader">
			<div class="spinner-border text-primary" role="status">
			<span class="sr-only">Loading...</span>
			</div>
		</div>

		<div id="public" class="site-wrap">
            @yield('content')
        </div>

        @yield('pagescript') 

	</body>
</html>