@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Country Edit</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('country-store')}}" method="post">
                        <div class="form-group">
                            <label>Country name</label>
                            <input class="form-control" type="text" name="country_name"/>
                        </div>
                        <div class="form-group">
                            <label>What seazon?</label>
                            <select class="form-control" name="seazon">
                                @foreach($seazons as $seazon)
                                <option value="{{$seazon->id}}">{{$seazon->seazon_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        @method('post')
                        <button class="btn btn-outline-success mt-4" type="submit">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection