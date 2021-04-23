@extends('layouts.app')
@section('title',  $flat->details->flat_title)

@section('content')
    {{-- onload mi permette di attivare una funzione di vue al caricamento della pagina  --}}
    <div class="container bnb-show" :onload="getInfoForMarker({{$flat->lon}}, {{$flat->lat}}, '{{$flat->details->flat_title}}', '{{$flat->details->price_day}}', '{{ $flat->street_name }} {{ $flat->street_number }} {{ $flat->municipality }}')">
        {{-- parte titolo e via --}}
        <div class="row">
            <div class="box-info-bnb col-12">
                <h1 class="card-title">{{ $flat->details->flat_title }}</h1>
                <p class="card-text"><b>Indirizzo:</b> {{ $flat->street_name }} {{ $flat->street_number }}
                    {{ $flat->municipality }} ({{ $flat->country_secondary_subdivision }})</p>
            </div>
        </div>
        {{-- parte immagine e mappa --}}
        <div class="row box-image-map-bnb">
            <div class="images-bnb col-md-12 col-lg-7">
                <img class="card-img-top" src="{{ $flat->details->image }}" alt="Card image cap">
            </div>
            {{-- map rendering --}}
            <div class="map-bnb col-md-12 col-lg-5">
                   <div id="map-div"></div>
            </div>
        </div>
        {{-- parte di servizzi e descrizione --}}
        <div class="row box-description-service-bnb">
            <div class="description col-md-12 col-lg-7 mt-2">
                <div class="box-desecription-bnb">
                    <h5 class="mt-2">Descrizione appartamento</h5>
                    <p class="">{{ $flat->details->description }}</p>
                </div>
            </div>
            <div class=" box-service-bnb col-md-12 col-lg-5 mt-2">
                <h5 class="mt-2">Servizi associati all'appartamento</h5>

                <ul class="list-group list-group-flush">
                    @foreach ($flat->services as $service)
                        <li class="list-group-item">{{ $service->service_name }}</li>
                     @endforeach
                 </ul>
            </div>
        </div>
        {{-- form message --}}
        <div class="row">
            <div class="card messages-bnb col-lg-12 mt-2">
                <h5 class="mt-2">Contatta il proprietario </h5>
                    <form action={{ route('message', compact("flat"))}} method="POST">
                        @csrf
                        @method("POST")
                        <div class="form-group col mt-2">
                            <label for="sender_mail">Email</label>
                            <input type="text" class="form-control {{ $errors->has('sender_mail') ? 'is-invalid' : '' }}"
                                value="{{ Auth::check() ? Auth::user()->email : '' }}" id="sender_mail" name="sender_mail"
                                placeholder="Email">
                            <div class="invalid-feedback">
                                Inserisci un'email valida
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="sender_name">Nome</label>
                            <input type="text" class="form-control {{ $errors->has('sender_name') ? 'is-invalid' : '' }}"
                                value="{{ Auth::check() ? Auth::user()->name : '' }}" id="sender_name" name="sender_name"
                                placeholder="Nome">
                            <div class="invalid-feedback">
                                Inserisci il tuo nome
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="sender_surname">Cognome</label>
                            <input type="text" class="form-control {{ $errors->has('sender_surname') ? 'is-invalid' : '' }}"
                                value="{{ Auth::check() ? Auth::user()->surname : '' }}" id="sender_surname" name="sender_surname"
                                placeholder="Cognome">
                            <div class="invalid-feedback">
                                Inserisci il tuo cognome
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="message_content">Messaggio</label>
                            <textarea type="text" class="form-control {{ $errors->has('message_content') ? 'is-invalid' : '' }}"
                                value="{{ isset($flat) ? $flat->message_content : '' }}" id="message_content" name="message_content"
                                placeholder="Messaggio"></textarea>
                            <div class="invalid-feedback">
                                Inserisci un'email valida
                            </div>
                        </div>
                        <button type="submit" class="btn" >
                            Invia
                        </button>
                    </form>
             </div>
        </div>
    </div>
@endsection
