<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use App\Models\Seazon;
use Illuminate\Http\Request;
use Image;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::all();
        return view ('back.hotel.index',['hotels'=> $hotels]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('back.hotel.create',['countries'=> $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotel = new Hotel;



        if ($request->file('hotel_photo')) {

            $photo = $request->file('hotel_photo');

            $ext = $photo->getClientOriginalExtension();

            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);

            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $Image = Image::make($photo)->pixelate(12);

            $Image->save(public_path().'/images/'.$file);

            $hotel->picture_path = asset('/images') . '/' . $file;

        }

        $hotel->hotel_name = $request->hotel_name;
        $hotel->price = $request->price;
        $hotel->duration = $request->duration;
        $hotel->country_id = $request->country;
        $hotel->save();

        return redirect()->route('hotel-list')->with('message', 'New hotel is added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $countries = Country::all();
        return view('back.hotel.edit', ['hotel'=> $hotel, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelRequest  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        if ($request->file('hotel_photo')) {


            $name = pathinfo($hotel->picture_path, PATHINFO_FILENAME);
            $ext = pathinfo($hotel->picture_path, PATHINFO_EXTENSION);
    
            $path = public_path() . '/images/' . $name . '.' . $ext;
    
            if (file_exists($path)) {
                unlink($path);
            }
            $photo = $request->file('hotel_photo');

            $ext = $photo->getClientOriginalExtension();

            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);

            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $Image = Image::make($photo)->pixelate(12);

            $Image->save(public_path().'/images/'.$file);

            $hotel->picture_path = asset('/images') . '/' . $file;

        }
        $hotel->hotel_name = $request->hotel_name;
        $hotel->price = $request->price;
        $hotel->duration = $request->duration;
        $hotel->country_id = $request->country;
        $hotel->save();

        return redirect()->route('hotel-list')->with('message', 'New hotel is edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        if ($hotel->picture_path) {
        $name = pathinfo($hotel->picture_path, PATHINFO_FILENAME);
        $ext = pathinfo($hotel->picture_path, PATHINFO_EXTENSION);

        $path = public_path() . '/images/' . $name . '.' . $ext;

            if (file_exists($path)) {
                unlink($path);
            }
        }
        dump($hotel);
        $hotel->delete();
        
        return redirect()->back()->with('mesage', 'Hotel have no photo now');
    }
}
