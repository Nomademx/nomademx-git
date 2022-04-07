<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Suburb;
use Illuminate\Http\Request;

class RealEstateSalesController extends Controller
{

    public function index() {

        $data['countries'] = Country::get(["country_name", "id"]);


        return view('real_estate.sales', $data);
    }

    public function getStates(Request $request){

        $data['states'] = State::where("country_id", $request->country_id)->get(["state_name", "id"]);
        return response()->json($data);
    }

    public function getCities(Request $request){

        $data['cities'] = City::where("state_id", $request->state_id)->get(["city_name", "id"]);
        return response()->json($data);

    }

    public function getSuburbs(Request $request){

        $data['suburbs'] = Suburb::where("city_id", $request->city_id)->get(["suburb_name", "total_male", "id"]);
        return response()->json($data);
    }
}
