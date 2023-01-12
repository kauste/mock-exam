@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit hotel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('hotel-update', $hotel)}}" method="post" enctype="multipart/form-data">
                        <div class=" form-group">
                        <label>Hotel name</label>
                        <input class="form-control" type="text" name="hotel_name" value="{{$hotel->hotel_name}}"/>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input class="form-control" type="number" name="price" min="0" step="any" value="{{$hotel->price}}"/>
                </div>
                <div class="form-group">
                    <label>Visit duration</label>
                    <input class="form-control" type="number" name="duration"value="{{$hotel->duration}}" />
                </div>
                <div class="form-group">
                    <label>What country?</label>
                    <select class="form-control" name="country">
                        @foreach($countries as $country)
                        <option value="{{$country->id}}" @if($country->id == $hotel->country_id) selected @endif>{{$country->country_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Portret of animal</label>
                    <input class="form-control" type="file" name="hotel_photo" />
                </div>
                @csrf
                @method('put')
                <div>
                <button class="btn btn-outline-success mt-4 m-4" type="submit">Edit</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
@endsection