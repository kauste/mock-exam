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
                                <th scope="col-1">Hotel Price</th>
                                <th scope="col-1">Vacation time</th>
                                <th scope="col-1">Country</th>
                                <th scope=""></th>
                                <th scope=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <form class="delete" action="{{route('change-state', $order)}}" method="post">
                            <tr>
                                <td scope="row">{{$order->name}}</td>
                                <td>{{$order->price}} eu.</td>
                                <td>{{$order->duration}} days</td>
                                <td>{{$order->country_name}}</td>
                                <td>
                                    <select class="form-control" name="condition">
                                        @foreach($states as $key => $state)
                                        <option value="{{$key}}" @if($key == $order->state) selected @endif>{{$state}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-outline-danger m-2">Change state</button>
                                    </form>
                                </td>
                            </tr>
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
