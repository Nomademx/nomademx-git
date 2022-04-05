

@extends('theme_layout.header')

@section('title', 'Ventas')

@section('content')


    <h1>Ventas</h1>
    <hr>

    

    <!-- TEST TEST TEST TEST TEST TEST TEST -->

<div class="col-4" style="margin: 0 auto;">
    <form>
        <div class="form-group mb-3">
            <select  id="country-dd" class="form-control">
                <option value="" selected disabled>Seleccionar país</option>
                @foreach ($countries as $data)
                <option value="{{$data->id}}">{{$data->country_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <select id="state-dd" class="form-control">
            </select>
        </div>

        <div class="form-group mb-3">
            <select id="city-dd" class="form-control">
            </select>
        </div>

        <div class="form-group">
            <select id="suburb-dd" class="form-control">
            </select>
        </div>

    </form>
</div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{route('getStates')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option selected disabled value="">Seleccionar estado</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.state_name + '</option>');
                        });
                    }
                });
            });
            $('#state-dd').on('change', function () {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{route('getCities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option selected disabled  value="">Seleccionar ciudad</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.city_name + '</option>');
                        });
                    }
                });
            });
            $('#city-dd').on('change', function () {
                var idCity = this.value;
                $("#suburb-dd").html('');
                $.ajax({
                    url: "{{route('getSuburbs')}}",
                    type: "POST",
                    data: {
                        city_id: idCity,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#suburb-dd').html('<option value="">Seleccionar ciudad</option>');
                        $.each(res.suburbs, function (key, value) {
                            $("#suburb-dd").append('<option value="' + value
                                .id + '">' + value.suburb_name + '</option>');
                        });
                    }
                });
            });
        });
    </script>


@endsection
