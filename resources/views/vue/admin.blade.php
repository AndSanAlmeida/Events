@extends('layouts.adminMaster')

@section('title', 'Dashboard')

@section('content')
    <admin-layout></admin-layout>
@endsection

@section('pagescript')

    <script src="{{ asset('js/adminVue.js') }}"></script>

    <script src="{{ asset('vendor/jQuery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/admin/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('vendor/admin/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin.js') }}"></script>
@stop