@extends('layouts.publicMaster')

@section('title', 'Home')

@section('content')
    <public-layout></public-layout>
@endsection

@section('pagescript')

    <script src="{{ asset('js/publicVue.js') }}"></script>

    <script src="{{ asset('vendor/jQuery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/public/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendor/public/isotope/isotope.min.js') }}"></script>
    <script src="{{ asset('vendor/public/lightcase/lightcase.js') }}"></script>
    <script src="{{ asset('vendor/public/waypoints/waypoint.min.js') }}"></script>
    <script src="{{ asset('vendor/public/countTo/jquery.countTo.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/public.js') }}"></script>

	{{-- <script>
			window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
			ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
		</script>
		<script src="https://www.google-analytics.com/analytics.js" async defer></script> --}}
@stop