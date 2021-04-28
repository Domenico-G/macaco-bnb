@extends('layouts.app')

@section('title', 'Cerca un appartamento')

@section('content')
    <div class="container-fluid bnb-search">
        {{-- searchbar --}}
        {{-- search input --}}
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center search-bar">
                <div class="search-input d-flex justify-content-between align-items-center">
                    <input v-model="address" v-on:keyup.enter="getFlats()" type="text"
                        placeholder="Dove ti porta il cuore?">

                    <i class="fas fa-search" v-on:click="getFlats()"></i>
                </div>

                <div v-on:click="toggleDropdownSection()" class="drop-section bnb-btn" title="Avanzate">
                    <i class="fas fa-angle-down"></i>
                </div>
            </div>
        </div>
        {{-- end search input --}}

        {{-- search advanced settings --}}
        <div :class="'row advanced-settings ' + classDropdownSection">
            <div class="container" v-cloak>
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

                        <input id="raggio-ricerca" v-model="distanceKm" type="range" min="2" step="2" max="80">

                        <span>@{{ distanceKm }}</span>
                    </div>

                    <div class="col-12">
                        <div class="container">
                            <div class="row v-cloak">
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

                    <div v-on:click="toggleDropdownSection()" class="col-12 lift-section bnb-btn">
                        <i class="fas fa-angle-up"></i>
                    </div>
                </div>
            </div>
        </div>
        {{-- end search advanced settings --}}
        {{-- end searchbar --}}

        <div class="container-fluid all-flats" v-cloak>
            {{-- sponsored flats section --}}
            <div class="row sponsored-flats" v-if="normalFlats.length === 0 && sponsoredFlats.length === 0">
                <div class="col-12">
                    <div class="container">
                        <div v-if="titleNoResultsFlag" class="empty-search">
                            <h1>
                                <em>Non ci sono risultati per @{{ titleSearchedInput }}</em>
                                <br>
                                <i class="fas fa-toilet-paper-slash"></i>
                            </h1>

                        </div>

                        <h1>Prima di cercare da un'occhiata a questi appartamenti in evidenza</h1>

                        {{-- sponsored flats --}}
                        @foreach ($sponsoredFlats as $flat)
                            <div class="container flat">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 flat-img-box">
                                        <a href="{{ route('public.flats.show', ['flat' => $flat->id]) }}">
                                            <img src="{{ $flat->details->image }}"
                                                alt="{{ $flat->details->flat_title }}">
                                        </a>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-12 flat-info">
                                        <a href="{{ route('public.flats.show', ['flat' => $flat->id]) }}">
                                            <h3 class="flat-title">
                                                {{ $flat->details->flat_title }}
                                            </h3>

                                            <p class="flat-text">
                                                {{ $flat->street_name }} {{ $flat->street_number }},
                                                {{ $flat->municipality }} {{ $flat->country_subdivision }}
                                            </p>

                                            <div class="flat-others-info">
                                                <div class="flat-others-info-quantities">
                                                    <ul class="d-flex justify-content-between">
                                                        <li title="Area in metri quadri">
                                                            <i class="fas fa-home"></i>
                                                            {{ $flat->details->area_sqm }}
                                                        </li>

                                                        <li title="Posti letto">
                                                            <i class="fas fa-bed"></i>
                                                            {{ $flat->details->beds_quantity }}
                                                        </li>

                                                        <li title="Stanze">
                                                            <i class="fas fa-vector-square"></i>
                                                            {{ $flat->details->rooms_quantity }}
                                                        </li>

                                                        <li title="Euro a notte">
                                                            <i class="fas fa-euro-sign"></i>
                                                            {{ $flat->details->price_day }}
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="services d-flex flex-wrap">
                                                    @foreach ($flat->services as $service)
                                                        <div>
                                                            {{ $service->service_name }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- end sponsored flats --}}
                    </div>
                </div>
            </div>
            {{-- end sponsored flats section --}}

            {{-- results section --}}
            <div class="row searched-flats">
                <div class="searched-flats-left col-xl-6 col-lg-12">
                        <h1 v-if="titleFlag">Risultati per @{{ titleSearchedInput }}</h1>

                        {{-- searched sponsored flat's results --}}
                        {{-- TODO: sistemare stile sponsorizzati --}}
                        <div v-for="flat in sponsoredFlats" class="container-fluid flat" style="background: gold;">
                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-12 flat-img-box">
                                    <a :href="'/flats/' + flat.id">
                                        <img :src="flat.details.image" :alt="flat . details . flat_title">
                                    </a>

                                    <div class=" bnb-flatSponsoredTag">
                                        IN EVIDENZA
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-12 flat-info">
                                    <a :href="'/flats/' + flat.id">
                                        <h3 class="flat-title">
                                            @{{ flat . details . flat_title }}
                                        </h3>

                                        <p class="flat-text">
                                            @{{ flat . street_name }} @{{ flat . street_number }},
                                            @{{ flat . municipality }} @{{ flat . country_subdivision }}
                                        </p>

                                        <div class="flat-others-info">
                                            <div class="flat-others-info-quantities">
                                                <ul class="d-flex justify-content-between">
                                                    <li title="Area in metri quadri">
                                                        <i class="fas fa-home"></i>
                                                        @{{ flat . details . area_sqm }}
                                                    </li>

                                                    <li title="Posti letto">
                                                        <i class="fas fa-bed"></i>
                                                        @{{ flat . details . beds_quantity }}
                                                    </li>

                                                    <li title="Stanze">
                                                        <i class="fas fa-vector-square"></i>
                                                        @{{ flat . details . rooms_quantity }}
                                                    </li>

                                                    <li title="Euro a notte">
                                                        <i class="fas fa-euro-sign"></i>
                                                        @{{ flat . details . price_day }}
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="services d-flex flex-wrap">
                                                <div v-for="service in flat.services">
                                                    @{{ service . service_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- end searched sponsored flat's results --}}

                        {{-- searched flat's results --}}
                        <div v-for="flat in normalFlats" class="container flat">
                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-12 flat-img-box">
                                    <a :href="'/flats/' + flat.id">
                                        <img :src="flat.details.image" :alt="flat . details . flat_title">
                                    </a>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-12 flat-info">
                                    <a :href="'/flats/' + flat.id">
                                        <h3 class="flat-title">
                                            @{{ flat . details . flat_title }}
                                        </h3>

                                        <p class="flat-text">
                                            @{{ flat . street_name }} @{{ flat . street_number }},
                                            @{{ flat . municipality }} @{{ flat . country_subdivision }}
                                        </p>

                                        <div class="flat-others-info">
                                            <div class="flat-others-info-quantities">
                                                <ul class="d-flex justify-content-between">
                                                    <li title="Area in metri quadri">
                                                        <i class="fas fa-home"></i>
                                                        @{{ flat . details . area_sqm }}
                                                    </li>

                                                    <li title="Posti letto">
                                                        <i class="fas fa-bed"></i>
                                                        @{{ flat . details . beds_quantity }}
                                                    </li>

                                                    <li title="Stanze">
                                                        <i class="fas fa-vector-square"></i>
                                                        @{{ flat . details . rooms_quantity }}
                                                    </li>

                                                    <li title="Euro a notte">
                                                        <i class="fas fa-euro-sign"></i>
                                                        @{{ flat . details . price_day }}
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="services d-flex flex-wrap">
                                                <div v-for="service in flat.services">
                                                    @{{ service . service_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- end searched flat's results --}}
                </div>

                <!-- map -->
                <div class="col-xl-6 col-lg-12 bnb-mapCol">
                    <div class="bnb-map-container">
                        <div id="map-div"></div>
                    </div>
                </div>
            </div>
            {{-- end results section --}}
        </div>

    </div>
@endsection
