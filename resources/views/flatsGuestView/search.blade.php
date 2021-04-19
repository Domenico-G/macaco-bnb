@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="search-bar">
            <label for="">Indirizzo</label>
            <input v-model="address" type="text">
            <label for="">Numero stanze</label>
            <input v-model="roomsNumber" type="number" >
            <label for="">Numero posti letto</label>
            <input v-model="bedsNumber" type="number">
            <label for="">Raggio di ricerca in km</label>
            <input v-model="distanceKm" type="number">
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

@endsection
