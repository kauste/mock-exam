<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Seazon;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view ('back.country.index',['countries'=> $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seazons = Seazon::all();
        return view('back.country.create',['seazons'=> $seazons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country;

        $country->country_name = $request->country_name;

        $country->seazon_id = $request->seazon;

        $country->save();

        return redirect()->route('country-list')->with('message', 'Country is edited!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    
    {
        $seazons = Seazon::all();
        return view('back.country.edit',['country'=> $country, 'seazons'=> $seazons]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country->country_name = $request->country_name;

        $country->seazon_id = $request->seazon;

        $country->save();

        return redirect()->route('country-list')->with('message', 'Country is edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->back()->with('message', 'Country is deleted');

    }
}
