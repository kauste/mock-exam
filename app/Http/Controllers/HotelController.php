<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use App\Models\Seazon;
use Illuminate\Http\Request;
use Image;


class HotelController extends Controller
{

    public function index()
    {
        $hotels = Hotel::all();
        return view ('back.hotel.index',['hotels'=> $hotels]);
    }

    public function create()
    {
        $countries = Country::all();
        return view('back.hotel.create',['countries'=> $countries]);
    }

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

    public function show(Hotel $hotel)
    {
        //
    }

    public function edit(Hotel $hotel)
    {
        $countries = Country::all();
        return view('back.hotel.edit', ['hotel'=> $hotel, 'countries' => $countries]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        if ($request->file('hotel_photo')) {
            if($hotel->picture_path){
                $name = pathinfo($hotel->picture_path, PATHINFO_FILENAME);
                $ext = pathinfo($hotel->picture_path, PATHINFO_EXTENSION);
                $path = public_path() . '/images/' . $name . '.' . $ext;
                if (file_exists($path)) {
                    unlink($path);
                }
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
        $hotel->delete();
        
        return redirect()->back()->with('mesage', 'Hotel have no photo now');
    }
}
