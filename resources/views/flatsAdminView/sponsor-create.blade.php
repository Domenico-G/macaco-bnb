@extends('layouts.app')

@section('title', 'Sponsorizza il tuo appartamento')

@section('content')
    <div class="container">
        <div>
            <h1>Sponsorizza il tuo appartamento!</h1>

            <p>
                Sponsorizza ora il tuo appartamento e questo verrà mostrato per primo nella homepage o se corrisponde ad una
                ricerca!
            </p>
        </div>

        @php
            if (count($flat->sponsor) > 0) {
                $sponsorEnd = $flat->sponsor[count($flat->sponsor) - 1]->sponsor_end;

                if($sponsorEnd > date("Y-m-d H:i:s")){
                    $sponsorActiveFlag = true;
                }else {
                    $sponsorActiveFlag = false;
                }
            }else{
                $sponsorEnd = 0;

                $sponsorActiveFlag = false;
            }
        @endphp

        @if (!$sponsorActiveFlag)
        <form action="{{ route('admin.sponsor.store', compact('flat')) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            @foreach ($sponsorTypes as $sponsorType)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sponsor-type" id="sponsor-type"
                        value="{{ $sponsorType->id }}">

                    <label class="form-check-label" for="sponsor-type">
                        Pacchetto {{ $sponsorType->sponsor_name }} Durata: {{ $sponsorType->sponsor_duration }} Prezzo:
                        {{ $sponsorType->sponsor_price }}
                    </label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @endif

        @if ($sponsorActiveFlag)
            <h2>Questo appartamento ha già una sponsorizzazione attiva in scadenza il {{$sponsorEnd}}</h2>
        @endif
    </div>
@endsection
