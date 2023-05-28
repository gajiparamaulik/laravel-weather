@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <script src="{{ asset('js/home.js') }}" defer></script>
</head>
    <article class="widget">
        <a href="/home">
            <div class="weatherIcon"></div>
            <div class="weatherData">
                <h1 class="temperature temp-font">{{ $location['main']['temp'] - 273.15 }} <span>&#8451;</span></h1>
                <h2 class="description">{{ $location['weather'][0]['description'] }}</h2>
                <h3 class="city">{{ $location['name']}} , {{ $location['sys']['country'] }}.</h3>
            </div>
            
            <div class="date">
                <h4 class="month" id="month"></h4>
                <h5 class="day" id="day"></h5>
            </div>
        </a>
    </article>
@endsection
