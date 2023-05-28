@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success p-0 w-45">
                <ul class="mt-2 mb-2">
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <form class="form-bg" method="post" action="{{ url('/temp-limit') }}">
            @foreach($selectedCity as $key=>$city)
            @csrf
                <label for="" class="col-sm-2 col-md-4 col-form-label">{{ $city['name'] }}</label>
                <div>
                    <input type="hidden" class="form-control" name="temp[{{$key}}][id]" value="{{$city['id'] }}">
                    <input type="number" class="form-control" name="temp[{{$key}}][temp_limit]" placeholder="Enter Limit" max="99" min="-5" value="{{ $city['temp_limit'] }}">
                    @if($city['response'])
                        @php 
                            $city['response'] = json_decode($city['response'], true);
                        @endphp
                    
                        <div class="d-flex flex-wrap bd-highlight mb-3">
                            <div class="p-2 bd-highlight">Temp. :- {{ $city['response']['main']['temp'] - 273.15 }} <span>&#8451;</span></div>
                            <div class="p-2 bd-highlight">Humidity :- {{ $city['response']['main']['humidity'] }}%</div>
                            <div class="p-2 bd-highlight">Wind :- {{ $city['response']['wind']['speed'] }}</div>
                        </div>
                    @endif
                </div>
            @endforeach
            <button type="submit" class="btn btn-warning mt-3">Submit</button>
        </form>
    </div>

<style>
    .w-45 {
        width: 45%;
    }
    .form-bg {
        background-color: #f9f9f9;
        padding: 15px 25px 15px 25px;
        max-width: 45%;
        border-radius: 15px;
    }
</style>

@endsection