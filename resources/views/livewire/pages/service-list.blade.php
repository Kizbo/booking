@extends('front')
@section('content')
    <div>
        If your happiness depends on money, you will never be happy with yourself.
    </div>
    <div id="calendar"></div>
@stop
@section('javascript')
    @vite(['resources/js/booking-calendar.js'])
@stop
