@extends('front')
@section('content')
    <div id="calendar"></div>
@stop
@section('javascript')
    @vite(['resources/js/fullcalendar-locale/pl.js'])
    @vite(['resources/js/booking-calendar.js'])
@stop
