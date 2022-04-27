@extends('adminlte::page')

@include('real_estate.map')

@section('title', 'Ventas')

@section('content')


    <h1 class="pt-4">Ventas</h1>
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
                <p>Precio promedio m2: <span id="sale_m2"></span></p>
                <p>N° Propiedades comparadas:</p>

                <hr>

                <h3><i class="fa-solid fa-house-chimney sale-sp-icon"></i>Preventa</h3>
                <p>Precio promedio m2: <span id="pre_sale_m2"></span></p>
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
                            <p id="total-population"></p>
                        </div>
                    </div>

                    <div class="graph-box">
                        <div class="icon-container">
                            <i class="fas fa-male user-ico"></i>
                            <h4>Hombres</h4>
                        </div>
                        <div class="data-container">
                            <p id="total-male"></p>
                        </div>
                    </div>

                    <div class="graph-box">
                        <div class="icon-container">
                            <i class="fas fa-female user-ico"></i>
                            <h4>Mujeres</h4>
                        </div>
                        <div class="data-container">
                            <p id="total-female"></p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    @section('css')
<!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles/style.css">
    @endsection

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

                        $('#suburb-dd').on('change', function(){
                            var idSuburb = this.value;

                            // Busca dentro del objeto por el Id de la colonia
                            var suburbInfo = $.grep(res.suburbs, function(res){
                                return res.id == idSuburb;
                            });

                            const totalMale = document.getElementById('total-male');
                            totalMale.innerHTML = suburbInfo[0].total_male;

                            const totalFemale = document.getElementById('total-female');
                            totalFemale.innerHTML = suburbInfo[0].total_female;

                            const totalPopulation = document.getElementById('total-population');
                            totalPopulation.innerHTML = suburbInfo[0].total_population;

                            const preSalePrice = document.getElementById('sale_m2');
                            preSalePrice.innerHTML = '$' + suburbInfo[0].pre_sale_m2 + ' pesos.';

                            const salePrice = document.getElementById('pre_sale_m2');
                            salePrice.innerHTML = '$' + suburbInfo[0].sale_m2 + ' pesos.';
                        });
                    }
                });
            });
            
        });
    </script>

{{--    <!-- Image map -->--}}


    <!-- From A CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@panzoom/panzoom/dist/panzoom.min.js"></script>

    <script>
        //get main container
        const elem = document.getElementById('panzoom');
        //get zoom in button
        const zoomInButton = document.getElementById('zoom-in');
        //get zoom out button
        const zoomOutButton = document.getElementById('zoom-out');
        //get reset button
        const resetButton = document.getElementById('reset');

        const panzoom = Panzoom(elem);
        const parent = elem.parentElement

        //enabling events
        parent.addEventListener('wheel', panzoom.zoomWithWheel);
        zoomInButton.addEventListener('click', panzoom.zoomIn)
        zoomOutButton.addEventListener('click', panzoom.zoomOut)
        resetButton.addEventListener('click', panzoom.reset)

        // const element = document.getElementById('panzoom')
        // const panzoom = Panzoom(element, {
        //     animate: true,
        //     canvas: true,
        //     cursor: 'move',
        //     disablePan: false,
        //     disableZoom: false,
        //     disableXAxis: false,
        //     disableYAxis: false,
        //     duration: 200,
        //     easing: 'ease-in-out',
        //     exclude: [],
        //     excludeClass: 'panzoom-exclude',
        //     handleStartEvent: function (e) {
        //         e.preventDefault();
        //         e.stopPropagation();
        //     },
        //     maxScale: 4,
        //     minScale: 0.125,
        //     overflow: 'hidden',
        //     panOnlyWhenZoomed: true,
        //     relative: true,
        //     setTransform: setTransform,
        //     startX: 0,
        //     startY: 0,
        //     startScale: 1,
        //     step: 0.3,
        //     contain: true,
        //     touchAction: 'none'
        // });
        //
        // panzoom.zoomOut(OPTIONS);

    </script>




    <script>


    </script>


@endsection
