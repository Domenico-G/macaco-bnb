@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card" style="width: 50%">
            <img class="card-img-top" src="{{ $flat->details->image }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $flat->details->flat_title }}</h5>
                <p class="card-text">{{ $flat->details->description }}</p>
                <p class="card-text"><b>Indirizzo:</b> {{$flat->street_name}} {{$flat->street_number}} {{$flat->municipality}} ({{$flat->country_secondary_subdivision}})</p>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($flat->services as $service)
                    <li class="list-group-item">{{ $service->service_name }}</li>
                @endforeach
            </ul>
            <div class="card-body">
                <a href="{{ route('home') }}" class="card-link">Ritorna alla home</a>
                <a href="{{ route('flat.edit', compact("flat")) }}" class="card-link">Modifica appartamento</a>

                <form action="{{ route('flat.destroy', compact("flat")) }}" class="card-link" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-default" type="submit">Elimina appartamento</button>
                </form>
            </div>
        </div>



    </div>

@endsection
