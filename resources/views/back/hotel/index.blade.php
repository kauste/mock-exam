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
                                <th scope="col"></th>
                                <th scope="col-1">Hotel Name</th>
                                <th scope="col-1">Hotel Price</th>
                                <th scope="col-1">Vacation time</th>
                                <th scope="col-1">Country</th>
                                <th scope=""></th>
                                <th scope=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hotels as $key => $hotel)
                            <tr>
                                <td><img class="hotel-img"src="{{$hotel->picture_path}}"></td>
                                <td scope="row">{{$hotel->hotel_name}}</td>
                                <td>{{$hotel->price}} eu.</td>
                                <td>{{$hotel->duration}} days</td>
                                <td>{{$hotel->country->country_name}}</td>

                            <td>
                                <a class="btn btn-outline-success m-2" href="{{route('hotel-edit', $hotel)}}">Edit</a>
                            </td>
                            <td>
                                <form class="delete" action="{{route('hotel-delete', $hotel)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger m-2">Destroy</button>
                                </form>
                            </td>
                            </tr>
                            @empty
                            <div>No hotels added</div>
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
