@extends('layouts.app')

@section('title', 'Home')
@section('content')
{{-- jumbotron fuori dal container per comprire il 100% della view --}}
    <div class="bnb-jumbotron">
        {{-- jumbotron video --}}
        <video playsinline autoplay muted loop>
            <source src="logo-img/jumbotron-video.mp4" type="video/mp4">
            <source src="logo-img/jumbotron-video.webm" type="video/webm">
            <source src="logo-img/jumbotron-video.ogg" type="video/ogg">
        </video>
        {{--
             Se il browser non dovesse supportare il video compare un carousel
        --}}
        <div class="carousel slide bnb-carousel" data-ride="carousel">
            <div class="carousel-inner bnb-carouselConteiner">
                <div class="carousel-item active bnb-carousContent">
                    <img class=" " src="logo-img/villa3.jpeg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class=" " src="logo-img/villa2.jpeg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class=" " src="logo-img/villa4.jpeg" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class=" " src="logo-img/villa1.jpeg" alt="Fourth slide">
                </div>
            </div>
        </div>



        {{-- jumbotron text --}}
        <div class="bnb-jumboTextContainer">
            <div class="bnb-textContent">
                <h1 class="display-4">Macaco B&B</h1>
                <p class="lead">
                    <em>
                        “Un viaggio di mille miglia comincia sempre con il primo passo”
                    </em>
                    <br>
                    <em style="margin-left: 15px">
                        - Lao Tzu
                    </em>
                </p>
            </div>

            {{-- <hr class="bnb-hrStyle"> --}}
            <p class="lead bnb-buttonContainer">
                <a class="btn btn-light btn-lg" href="{{route("public.flats.search")}}" role="button">
                    Cerca il tuo Appartamento
                </a>
            </p>
        </div>
    </div>
    {{-- flats section --}}
    <div class="bnb-flatsContainer">
        <div class="container d-flex flex-wrap bnb-cardContainer">
            <div class="row">
                @foreach ($flats as $key => $flat)
                    <div class="col-lg-4 col-md-6 col-xs-12 bnb-card">
                        <div class="row">
                            <div class="col-12">
                                <div class=" card bnb-cardContent">
                                    <img class="" src="{{$flat->details->image}}" alt="Card image cap">
                                    <div class=" bnb-cardBody">
                                        <h5 class="bnb-cardTitle">
                                            {{$flat->details->flat_title}}
                                        </h5>
                                    </div>
                                    <div class="bnb-buttonContainer">
                                        <a href="{{route('public.flats.show', ['flat'=>$flat->id])}}" class="btn btn-primary bnb-button">
                                            Visualizza Appartamento
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- carousel --}}

@endsection
