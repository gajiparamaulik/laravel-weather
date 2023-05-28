@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success p-0">
                <ul class="mt-2 mb-2">
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <form class="form-control" method="post" action="{{ route('addCities') }}">
            @csrf
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-control" id="country_id">
                    @foreach($country as $con)
                        <option value="{{ $con->id }}">{{ $con->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <select class="form-control" id="state_id"></select>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select class="js-example-basic-multiple" name="city[]" id="city_id" multiple="multiple">
                    @foreach($indiaCity as $city)
                        <option {{ in_array($city->name, $selectedCity) ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select multiple class="form-select" name="city[]" id="city_id" >
                    @foreach($indiaCity as $city)
                        <option {{ in_array($city->name, $selectedCity) ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>

    <button class="btn btn-info float-end">
        <a href="/weather" target="_blank">Weather Checking</a>
    </button>

<script>
    document.getElementById('country_id').addEventListener('change', function() {
    axios.get('/api/state/'+ this.value)
        .then(function (res) {
            let stateHTML = '';
            const array = res.data.state;
            array.forEach(function (item, index) {
                stateHTML += "<option value='"+item.id+"'>"+ item.name +"</option>" 
            });
            document.getElementById("state_id").innerHTML = stateHTML;
            
        })
        .catch(function (error) {
            console.log(error);
        });
    });

    document.getElementById('state_id').addEventListener('change', function() {
    axios.get('/api/city/'+ this.value)
        .then(function (res) {
            let cityHTML = '';
            const array = res.data.city;
            array.forEach(function (item, index) {
                cityHTML += "<option value='"+item.id+"'>"+ item.name +"</option>" 
            });
            document.getElementById("city_id").innerHTML = cityHTML;
        })
        .catch(function (error) {
            console.log(error);
        });
    });

    document.getElementById('state_id').addEventListener('change', function() {
    axios.get('/api/city/'+ this.value)
        .then(function (res) {
            let cityHTML = '';
            const array = res.data.city;
            array.forEach(function (item, index) {
                cityHTML += "<option value='"+item.id+"'>"+ item.name +"</option>" 
            });
            document.getElementById("city_id").innerHTML = cityHTML;
        })
        .catch(function (error) {
            console.log(error);
        });
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            width:"100",
            dropdownAutoWidth:true,
            theme: "classic",
        });
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
