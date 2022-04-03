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

        $countries = Country::all();
        $cities = City::all();
        $suburbs = Suburb::all();
//

        return view('real_estate.sales', compact('countries'));
    }

    public function getStates(Request $request){

        if(isset($request->texto)) {
            $states = State::whereCountry_id($request->texto)->get();
            return response()->json([
                'lista' => $states,
                'success' => true
            ]);
        }
        else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getCities(){

    }

    public function getSuburbs(){

    }
}
