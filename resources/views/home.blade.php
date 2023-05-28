@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/weather"><button class="btn btn-info float-end">Check Weather</button></a>
</div>
    <div class="container mt-5">
        @if (\Session::has('success'))
            <div class="alert alert-success p-0" id="successMsg">
                <ul class="mt-2 mb-2">
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <form class="form-control" method="post" action="{{ route('addCities') }}">
            @csrf
            <div class="mb-3 d-none">
                <label for="country" class="form-label">Country</label>
                <select class="form-control" id="country_id">
                    <option value=""></option>
                </select>
            </div>
            
            <div class="mb-3 d-none">
                <label for="state" class="form-label">State</label>
                <select class="form-control" id="state_id"></select>
            </div>

            <div class="mb-3 mt-3 mb-3">
                <label for="city" class="form-label">City</label>
                <select class="js-example-basic-multiple" name="city[]" id="city_id" multiple="multiple">
                    @foreach($indiaCity as $city)
                        <option {{ in_array($city->name, $selectedCity) ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>


<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            width:"100",
            dropdownAutoWidth:true,
            theme: "classic",
        });
    });

    $("document").ready(function(){
        setTimeout(function(){
            $("#successMsg").fadeOut();
        }, 3000 ); 
    });

</script>

<style>
span.select2-selection.select2-selection--multiple {
    width: 460px;
}
span.select2-dropdown.select2-dropdown--below {
    width: 460px !important;
}
span.select2-results {
    width: 460px;
}
</style>

@endsection
