@extends('layouts.app')
@section('content')
<div class="container-sm mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Hotel list</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col-1">User Name</th>
                                <th scope="col-1">Hotel Price</th>
                                <th scope="col-1">Vacation time</th>
                                <th scope="">State</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <div class="delete" action="{{route('change-state', $order)}}" method="post">
                            <tr>
                                <td scope="row">{{$order->name}}</td>
                                <td>{{$order->price}} eu.</td>
                                <td>{{$order->duration}} days</td>
                                <td>{{$states[$order->state]}}</td> 
                            </tr>
                            </div>
                            @empty
                            <div>No orders added</div>
                            @endforelse
                        </tbody>
                    </table>
                    </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection