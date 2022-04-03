

@extends('theme_layout.header')

@section('title', 'Ventas')

@section('content')


    <h1>Ventas</h1>
    <hr>

    <div class="content-sales-box">

{{--        <div class="panel-sales">--}}
{{--            <select class="form-select mb-4" aria-label="Default select example" id="country">--}}

{{--                <option selected >Seleccione un Pais</option>--}}
{{--                <option value disabled>—————————————</option>--}}

{{--                @foreach( $countries as $country)--}}
{{--                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>--}}
{{--                @endforeach--}}

{{--            </select>--}}
{{--            <!-- ------------------------------ -->--}}

{{--            <select class="form-select mb-4" aria-label="" id="state">--}}

{{--                <option selected >Seleccione un estado</option>--}}
{{--                <option value disabled>—————————————</option>--}}


{{--            </select>--}}
{{--            <!-- ------------------------------ -->--}}

{{--            <select class="form-select mb-4" aria-label="" id="city">--}}

{{--                <option selected >Seleccione una ciudad</option>--}}
{{--                <option value disabled>—————————————</option>--}}


{{--            </select>--}}

{{--            <!-- ------------------------------ -->--}}

{{--            <select class="form-select" aria-label="Default select example" id="suburb">--}}

{{--                <option selected >Seleccione una colonia</option>--}}
{{--                <option value disabled>—————————————</option>--}}


{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="dashboard-sales">--}}
{{--            <!-- Dashboard sales here... -->--}}
{{--            <hr>--}}
{{--            <select class="js-example-basic-single" name="state">--}}
{{--                <option value="AL">Alabama</option>--}}
{{--                ...--}}
{{--                <option value="WY">Wyoming</option>--}}
{{--            </select>--}}
{{--        </div>--}}

    </div>


    <!-- TEST TEST TEST TEST TEST TEST TEST -->

    <select name="" id="country">
        @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
        @endforeach
    </select>

    <br>

    <select name="" id="state"></select>

    <br>

    <select name="" id="city"></select>

    <script>
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

        document.getElementById('country').addEventListener('change',(e)=>{
            fetch('getStates', {
                method: 'POST',
                body: JSON.stringify({texto : e.target.value}),
                headers:{
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            }).then(response =>{
                return response.json()
            }).then(data =>{
                var options = "";
                for (let i in data.list){
                    options += '<option value="'+data.lista[i].id+'">'+data.lista[i].id+'</option>';
                }
                document.getElementById("state").innerHTML = options;
            }).catch(error => console.error(error));
        });
    </script>


@endsection
