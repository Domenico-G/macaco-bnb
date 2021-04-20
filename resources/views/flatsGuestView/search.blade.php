@extends('layouts.app')

@section('content')

    <div class="container bnb-search">
        <div class="search-bar justify-content-between row">
            <div class="col-lg-3 col-md-3 col-sm-12">
             <label for="">indirizzo</label>
             <input v-model="address" type="text" placeholder="Indirizzo">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
             <label for="">Numero stanze</label>
             <input v-model="roomsNumber" type="number" >
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
             <label for="">Numero posti letto</label>
             <input v-model="bedsNumber" type="number">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
             <label for="">Raggio di ricerca in km</label>
             <input v-model="distanceKm" type="number">
           </div>


            <button v-on:click="getFlats()"> cerca</button>
        </div>
        <div class="flats-cards d-flex flex-wrap">
            <div v-for="flat in flatsArr" class="card" style="width: 18rem;">
                <img class="card-img-top" :src="flat.details.image" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">@{{ flat.details.flat_title }}</h5>
                    <p class="card-text">@{{ flat.details.description }}</p>
                    <p class="card-text">@{{ flat.street_name }} @{{ flat.street_number }} @{{ flat.municipality }}</p>
                    <a :href="'/flats/' + flat.id" class="btn btn-primary">Visualizza</a>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown button
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach ($services as $service )
            <div class="form-check">
                <input class="form-check-input" v-model="checkedServices" type="checkbox" value="{{$service->id}}" name="{{$service->service_name}}">
                <label class="form-check-label" for="{{$service->service_name}}">{{$service->service_name}}</label>
            </div>
            @endforeach

        </div>
      </div>


@endsection
