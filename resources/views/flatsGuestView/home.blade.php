@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-wrap">
        @foreach ($flats as $key => $flat)
            <div class="card col-4">
                <img class="card-img-top" src="{{$flat->details->image}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$flat->details->flat_title}}</h5>
                    <p class="card-text">{{$flat->details->description}}</p>
                    <a href="{{route('public.flats.show', ['flat'=>$flat->id])}}" class="btn btn-primary">Visualizza Appartamento</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

