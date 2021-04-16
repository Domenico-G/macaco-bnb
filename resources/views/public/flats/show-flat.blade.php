@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card" style="width: 50%">
            <img class="card-img-top" src="{{ $flat->details->image }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $flat->details->flat_title }}</h5>
                <p class="card-text">{{ $flat->details->description }}</p>
                <p class="card-text"><b>Indirizzo:</b> {{ $flat->street_name }} {{ $flat->street_number }}
                    {{ $flat->municipality }} ({{ $flat->country_secondary_subdivision }})</p>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($flat->services as $service)
                    <li class="list-group-item">{{ $service->service_name }}</li>
                @endforeach
            </ul>
            <div class="card-body">
                <a href="{{ route('home') }}" class="card-link">Ritorna alla home</a>
                <a href="{{ route('flat.edit', compact('flat')) }}" class="card-link">Modifica appartamento</a>

                <form action="{{ route('flat.destroy', compact('flat')) }}" class="card-link" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-default" type="submit">Elimina appartamento</button>
                </form>
            </div>
        </div>

        {{-- form message --}}
        <form action={{ route('message', compact("flat"))}} method="POST">
            @csrf
            @method("POST")
            <div class="form-group col">
                 <label for="sender_mail">Email</label>
                 <input type="text" class="form-control {{ $errors->has('sender_mail') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->sender_mail : '' }}" id="sender_mail" name="sender_mail"
                     placeholder="Email">
                 <div class="invalid-feedback">
                     Inserisci un'email valida
                 </div>
             </div>
             <div class="form-group col">
                 <label for="sender_name">Nome</label>
                 <input type="text" class="form-control {{ $errors->has('sender_name') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->sender_name : '' }}" id="sender_name" name="sender_name"
                     placeholder="Nome">
                 <div class="invalid-feedback">
                     Inserisci il tuo nome
                 </div>
             </div>
             <div class="form-group col">
                 <label for="sender_surname">Cognome</label>
                 <input type="text" class="form-control {{ $errors->has('sender_surname') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->sender_surname : '' }}" id="sender_surname" name="sender_surname"
                     placeholder="Cognome">
                 <div class="invalid-feedback">
                     Inserisci il tuo cognome
                 </div>
             </div>
             <div class="form-group col">
                 <label for="message_content">Messaggio</label>
                 <input type="text" class="form-control {{ $errors->has('message_content') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->message_content : '' }}" id="message_content" name="message_content"
                     placeholder="Messaggio">
                 <div class="invalid-feedback">
                     Inserisci un'email valida
                 </div>
             </div>
             <button type="submit" class="btn btn-primary">Invia</button>
        </form>



    </div>

@endsection
