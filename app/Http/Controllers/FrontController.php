<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;

class FrontController extends Controller
{
    public function show(Request $request){

        if ($request->s) {
            $hotels = [Hotel::
                join('countries', 'hotels.country_id', '=',  'countries.id')
                ->select('countries.*', 'hotels.*', 'hotels.id as hotel_id')
                ->where('hotels.hotel_name', 'like', '%'.$request->s.'%')
                ->get(), 'default'];
            $filter = 0;

        }
        else{
            if(!$request->country_id){
                $hotels = match($request->sort){
                    'price-asc' => [Hotel::join('countries', 'hotels.country_id', '=',  'countries.id')
                    ->select('countries.*', 'hotels.*', 'hotels.id as hotel_id')
                    ->orderBy('hotels.price', 'asc')->get(), 'price-asc'],
                    'price-desc'=> [Hotel::join('countries', 'countries.id', '=', 'hotels.country_id')
                    ->select('countries.*', 'hotels.*', 'hotels.id as hotel_id')
                    ->orderBy('hotels.price', 'desc')->get(), 'price-desc'],
                    default => [Hotel::all(), 'default'],
                };
                $filter = 0;
            }
            else {
                $hotels = match($request->sort){
                    'price-asc' => [Hotel::join('countries', 'hotels.country_id', '=',  'countries.id')
                    ->select('countries.*', 'hotels.*', 'hotels.id as hotel_id')
                    ->where('countries.id', $request->country_id)
                    ->orderBy('hotels.price', 'asc')->get(), 'price-asc'],
                    'price-desc'=> [Hotel::join('countries', 'countries.id', '=', 'hotels.country_id')
                    ->select('countries.*', 'hotels.*', 'hotels.id as hotel_id')
                    ->where('countries.id', $request->country_id)
                    ->orderBy('hotels.price', 'desc')->get(), 'price-desc'],
                    default => [Hotel::join('countries',  'countries.id', '=', 'hotels.country_id')
                    ->select('countries.*', 'hotels.*', 'hotels.id as hotel_id')
                    ->where('hotels.country_id', $request->country_id)
                    ->get(), 'default'],
                };
                $filter = (int) $request->country_id;
            }
            
    }
        return view('front.index', ['hotels'=> $hotels[0], 
                                    'countries' => Country::all(), 
                                    'sort'=> $hotels[1],
                                    'filter'=> $filter ?? 0]);
    }

}
