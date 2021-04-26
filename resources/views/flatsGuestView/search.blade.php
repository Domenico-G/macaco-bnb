@extends('layouts.app')

@section('title', 'Cerca un appartamento')

@section('content')
<div class="container-fluid bnb-pagaSearchWrap">
    <div class="row">
        <div class="col-lg-6 col-sm-12 bnb-flatCol">
            {{-- searchbar --}}
            {{-- search input --}}
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center search-bar">
                    <div class="search-input d-flex justify-content-between align-items-center">
                        <input v-model="address" v-on:keyup.enter="getFlats()" type="text" placeholder="Dove ti porta il cuore?">

                        <i class="fas fa-search" v-on:click="getFlats()"></i>
                    </div>

                    <div v-on:click="toggleDropdownSection()" class="drop-section bnb-btnSearch" title="Avanzate">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
            </div>
            {{-- end search input --}}

            {{-- search advanced settings --}}
            <div :class="'row advanced-settings ' + classDropdownSection">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <label for="numero-stanze">Numero stanze</label>

                            <input name="numero-stanze" v-model="roomsNumber" type="number" min="0">
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <label for="numero-letti">Numero posti letto</label>

                            <input v-model="bedsNumber" name="numero-letti" type="number" min="0">
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <label for="raggio-ricerca">Raggio di ricerca in km</label>

                            <input id="raggio-ricerca"  v-model="distanceKm" type="range" min="2" step="2" max="80">

                            <span>@{{distanceKm}}</span>
                        </div>
                        <div class="col-12">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3>Servizi:</h3>
                                    </div>
                                    @foreach ($services as $service)
                                    <div class="col-lg-3 col-md-6 col-sm-12 form-check">
                                        <input class="form-check-input" v-model="checkedServices" type="checkbox"
                                        value="{{ $service->id }}" id="checkbox-{{ $service->id }}">

                                        <label class="form-check-label"
                                        for="checkbox-{{ $service->id }}">{{ $service->service_name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div v-on:click="toggleDropdownSection()" class="col-12 lift-section bnb-btnSearch">
                            <i class="fas fa-angle-up"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end search advanced settings --}}
            {{-- end searchbar --}}

            {{-- results section --}}
            <div class="row bnb-resultRow">
                <div class="col-12">
                    <div class="container bnb-resultSearch" >
                        <h1 v-if="titleFlag">Risultati per @{{titleSearchedInput}}</h1>
                        <h1 v-if="titleNoResultsFlag">Non ci sono risultati per @{{titleSearchedInput}}</h2>

                        {{-- flat's results --}}
                        <div v-for="flat in flatsArr" class="container flat">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 flat-img-box">
                                    <a :href="'/flats/' + flat.id">
                                        <img :src="flat.details.image" :alt="flat.details.flat_title">
                                    </a>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 flat-info">
                                    <a :href="'/flats/' + flat.id">
                                        <h3 class="flat-title">
                                            @{{ flat.details.flat_title }}
                                        </h3>

                                        <p class="flat-text">
                                            @{{ flat.street_name }} @{{ flat.street_number }},
                                            @{{ flat.municipality }} @{{ flat.country_subdivision }}
                                        </p>

                                        <div class="flat-others-info">
                                            <div class="flat-others-info-quantities">
                                                <ul class="d-flex justify-content-between">
                                                    <li title="Area in metri quadri">
                                                        <i class="fas fa-home"></i>
                                                        @{{ flat.details.area_sqm }}
                                                    </li>

                                                    <li title="Posti letto">
                                                        <i class="fas fa-bed"></i>
                                                        @{{ flat.details.beds_quantity }}
                                                    </li>

                                                    <li title="Stanze">
                                                        <i class="fas fa-vector-square"></i>
                                                        @{{ flat.details.rooms_quantity }}
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="services d-flex flex-wrap">
                                                <div v-for="service in flat.services">
                                                    @{{service.service_name}}
                                                </div>
                                            </div>

                                            <div class="flat-others-info-price">
                                                <div>
                                                    <strong>@{{ flat . details . price_day }}&euro;</strong>/notte
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- end flat's results --}}
                    </div>
                </div>
            </div>
            {{-- end results section --}}
        </div>
        <div class="col-lg-6 col-sm-12 bnb-mapCol">
            <div class="bnb-map-container">
                <div id="map-div"></div>
             </div>
        </div>
    </div>
</div>
@endsection
