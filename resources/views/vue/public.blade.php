@extends('layouts.publicMaster')

@section('title', 'Home')

@section('content')
    <public-header-mobile></public-header-mobile>
    <public-header></public-header>
    <router-view></router-view>
    <public-footer></public-footer>
@endsection

@section('pagescript')

    <script src="{{ asset('js/publicVue.js') }}"></script>

    <script src="{{ asset('vendor/jQuery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('vendor/public/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/public/stickyFill/stickyfill.min.js') }}"></script>
    <script src="{{ asset('vendor/public/fancybox/fancybox.min.js') }}"></script>
    <script src="{{ asset('vendor/public/jQueryEasing/jquery.easing.1.3.js') }}"></script>

    <script src="{{ asset('vendor/public/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('vendor/public/animateNumber/animateNumber.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/public.js') }}"></script>

	{{-- <script>
			window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
			ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
		</script>
		<script src="https://www.google-analytics.com/analytics.js" async defer></script> --}}
@stop