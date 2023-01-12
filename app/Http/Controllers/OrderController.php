<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::join('hotels', 'orders.hotel_id', '=', 'hotels.id')
        // ->select('orders.id as orders_id', 'hotels.id as hotels_id', 'hotels.*', 'orders.*')
        ->join('users', 'orders.user_id', '=', 'users.id')
        // ->select('users.*', 'orders.*', 'orders.id as orders_id', 'users.id as users')
        ->get();

        $states = Order::STATES;
        return view('back.orders.index', ['orders'=>$orders, 'states' => $states]);
    }

    public function orderVacation(Request $request, Hotel $hotel){
        $order = new Order;
        $order->hotel_id = $hotel->id;
        $order->user_id = Auth::user()->id;
        $order->save();
        return redirect()->back()->with('message', 'Your travel is booked');
    }
    public function changeState(Request $request, Order $order){
        $order->state = $request->condition;
        $order->save();
        return redirect()->back()->with('message', 'Order state is changed.');
    }
    public function myOrders(){
        $orders = Order::join('hotels', 'orders.hotel_id', '=', 'hotels.id')
        // ->select('orders.id as orders_id', 'hotels.id as hotels_id', 'hotels.price as price', 'orders.*')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('users.id', '=', Auth::user()->id)
        // ->select('users.*', 'orders.*', 'orders.id as orders_id', 'users.id as users')
        ->get();
        $states = Order::STATES;
        return view('front.orders', ['orders'=>$orders, 'states' => $states]);
    }
}
