@extends('layouts.app')

@section('title', 'Home')
@section('content')
{{-- jumbotron fuori dal container per comprire il 100% della view --}}
    <div class="bnb-jumbotron">
        {{-- jumbotron video --}}
        <video playsinline autoplay muted loop>
            <source src="logo-img/jumbotron-video.mp4" type="video/mp4">
        </video>
        {{-- jumbotron text --}}
        <div class="bnb-jumboTextContainer">
            <div class="bnb-textContent">
                <h1 class="display-4">Macaco B&B</h1>
                <p class="lead">
                    “Un viaggio di mille miglia comincia sempre con il primo passo” ...Lao Tzu...
                </p>
            </div>

            <hr class="bnb-hrStyle">
            <p class="lead bnb-buttonContainer">
                <a class="btn btn-light btn-lg" href="{{route("public.flats.search")}}" role="button">
                    Cerca il tuo Appartamento
                </a>
            </p>

        </div>

    </div>
    {{-- flats section --}}
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
