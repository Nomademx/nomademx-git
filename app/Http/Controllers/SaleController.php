<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Sale;
use App\Models\State;
use App\Models\Suburb;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::get();

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sale $sale)
    {
        $data['countries'] = Country::get(["country_name", "id"]);
        $property_types = $sale->getPropertyTypes();
        $sale_types = $sale->getSaleTypes();

        // $sale_types = ['Renta', 'Venta', 'Preventa'];
        return view('sales.create', $data, compact('property_types', 'sale_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->request->add(['user_id' => $user->id]);

        $input = $request->validate([
            'user_id'         => 'required',
            'country_id'      => 'required',
            'state_id'        => 'required',
            'city_id'         => 'required',
            'suburb_id'       => 'required',
            'image'           => 'required|image',
            'description'     => 'required',
            'property_type'   => 'required',
            'price'           => 'required',
            'sale_type'       => 'required',
            'street'          => 'required'
        ]);

        $input['image'] = $request->file('image')->store('SaleImages');

        Sale::create($input);

        return redirect('sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view ('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
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

        $data['suburbs'] = Suburb::where("city_id", $request->city_id)->get();
        return response()->json($data);
    }
}
