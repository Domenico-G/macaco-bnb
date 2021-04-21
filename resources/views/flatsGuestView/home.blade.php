@extends('layouts.app')

@section('title', 'Home')
@section('content')
{{-- jumbotron fuori dal container per comprire il 100% della view --}}
    <div class="bnb-jumbotron">
        {{-- jumbotron video --}}
        <video playsinline autoplay muted loop>
            <source src="imageOfPage/jumbotron-video/jumbotron-video.mp4" type="video/mp4">
            <source src="imageOfPage/jumbotron-video/jumbotron-video.webm" type="video/webm">
            <source src="imageOfPage/jumbotron-video/jumbotron-video.ogg" type="video/ogg">
        </video>
        {{--
             Se il browser non dovesse supportare il video compare un carousel
        --}}
        <div class="carousel slide bnb-carousel" data-ride="carousel">
            <div class="carousel-inner bnb-carouselConteiner">
                {{--
                    il primo elemento del carousel deve essere sempre esplicitato poichè ha la classe active che serve a bootstrap per far partire il carousel automatico
                --}}
                <div class="carousel-item active bnb-carousContent">
                    <img class=" " src="imageOfPage/jumbo-carousel/villa3.jpeg" alt="First slide">
                </div>
                <div v-for= "element in carouselJumbo" class="carousel-item">
                    <img class=" " :src="element.imgJumbo" :alt="element.bootStrapAlt">
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
        <div class="row">
            <div class="container-fluid bnb-titleSection">
                <h4>In Primo Piano</h4>
            </div>
        </div>
        <div class="container d-flex flex-wrap bnb-cardContainer">
            <div class="row">
                @foreach ($flats as $key => $flat)
                    <div class="col-lg-4 col-md-6 col-xs-12 bnb-card">
                        <div class="row">
                            <div class="col-12">
                                <div class=" card bnb-cardContent">
                                    <img class="bnb-imgCard" src="{{$flat->details->image}}" alt="Card image cap">
                                    <div class=" bnb-cardBody">
                                        <h5 class="bnb-cardTitle">
                                            {{$flat->details->flat_title}}
                                        </h5>
                                    </div>
                                    <div class="bnb-buttonContainer">
                                        <a href="{{route('public.flats.show', ['flat'=>$flat->id])}}" class="btn btn-dark bnb-button">
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

    {{-- diventa un Host section --}}
    <div class="jumbotron jumbotron-fluid bnb-jumboMain">
        <div class="container">
          <h1 class="display-4">
              <a href="{{ route('register') }}">Diventa un HOST</a>
            </h1>
          <p class="lead">
              Condividi il tuo spazio per guadagnare <br/>
              qualcosa in più e scoprire nuove opportunità.
            </p>
        </div>
      </div>

    {{-- carousel of main page --}}

        <div id="carouselExampleIndicators" class="carousel slide bnb-slide" data-ride="carousel">

            <div class="carousel-inner">
                <div class="bnb-buttonContainer">
                    <p class="lead bnb-buttonContent">
                        <a class="btn btn-light btn-lg" href="{{route("public.flats.search")}}" role="button">
                            Cerca il tuo Appartamento
                        </a>
                    </p>
                </div>
              <div class="carousel-item active">
                <img class="d-block" style="width: 80%;margin: 0 auto;" src="imageOfPage/main-carousel/venezia.jpeg" alt="First slide">
              </div>
              <div v-for="item in mainCarousel" class="carousel-item">
                <img class="d-block" style="width: 80%;margin: 0 auto;" :src="item.imgCarousel" :alt="item.bootStrapAlt">
              </div>
              <ol  class="carousel-indicators bnb-carouselIndicators md-hide">
                <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                  <li v-for="num in mainCarousel" data-target="#carouselIndicators" :data-slide-to="num.dataSlideTo" class=""></li>
              </ol>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>


        </div>









@endsection
