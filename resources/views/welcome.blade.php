@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <script src="{{ asset('js/home.js') }}" defer></script>
</head>
    <article class="widget">
        <div class="weatherIcon"></div>
        <div class="weatherData">
            <h1 class="temperature">28&deg;</h1>
            {{-- <h2 class="description">{{ $location->regionCode }}</h2> --}}
            <h3 class="city">Bangalore, Karnataka.</h3>
        </div>
        
        <div class="date">
            <h4 class="month" id="month"></h4>
            <h5 class="day" id="day"></h5>
        </div>
    </article>
	{{-- <h3>IP: {{ $curLocation->ip }}</h3>
	<h3>Country Name: {{ $curLocation->countryName }}</h3>
	<h3>Country Code: {{ $curLocation->countryCode }}</h3>
	<h3>Region Code: {{ $curLocation->regionCode }}</h3>
	<h3>Region Name: {{ $curLocation->regionName }}</h3>
	<h3>City Name: {{ $curLocation->cityName }}</h3>
	<h3>Zipcode: {{ $curLocation->zipCode }}</h3>
	<h3>Latitude: {{ $curLocation->latitude }}</h3>
	<h3>Longitude: {{ $curLocation->longitude }}</h3> --}}
@endsection
