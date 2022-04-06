

@extends('theme_layout.header')
@include('real_estate.map')

@section('title', 'Ventas')

@section('content')


    <h1>Ventas</h1>
    <hr>

    <div class="sales-container">
        <div class="sales-select-container">
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

        <div class="dashboard-container">

            <div class="dash-left">
                <h3><i class="fa-solid fa-house-chimney sale-sp-icon"></i>Venta</h3>
                <p>Precio promedio m2:</p>
                <p>N° Propiedades comparadas:</p>

                <hr>

                <h3><i class="fa-solid fa-house-chimney sale-sp-icon"></i>Preventa</h3>
                <p>Precio promedio m2:</p>
                <p>N° Propiedades comparadas:</p>
            </div>

            <div class="dash-right">
                <div class="map-temp">

                    @yield('map')

                </div>
                <h3>Información demográfica del area</h3>
                <div class="graph-container">

                    <div class="graph-box">
                        <div class="icon-container">
                            <i class="fa-solid fa-users user-ico"></i>
                            <h4>Total</h4>
                        </div>
                        <div class="data-container">
                            <p>0</p>
                        </div>
                    </div>

                    <div class="graph-box">
                        <div class="icon-container">
                            <i class="fas fa-male user-ico"></i>
                            <h4>Hombres</h4>
                        </div>
                        <div class="data-container">
                            <p>0</p>
                        </div>
                    </div>

                    <div class="graph-box">
                        <div class="icon-container">
                            <i class="fas fa-female user-ico"></i>
                            <h4>Mujeres</h4>
                        </div>
                        <div class="data-container">
                            <p>0</p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
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
