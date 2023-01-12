@extends('layouts.app')
@section('content')
<div class="container-sm mt-5">
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        @foreach($countries as $country)
                        <li class="list-group-item list-display">
                            <div><b>{{$country->country_name}}</b></div>
                            <div>{{$country->seazon->seazon_name}}</div>
                            <div class="controls">
                                <a class="btn btn-outline-success m-2" href="{{route('country-edit', $country)}}">Edit</a>
                                <form class="delete" action="{{route('country-delete', $country)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger m-2">Destroy</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
    </div>
</div>
@endsection
