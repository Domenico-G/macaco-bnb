@extends("layouts.app")
@section('title', 'Dashboard di ' . Auth::user()->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row heard-dashoboard">
                    <div class="">
                        <h2>Ciao {{ Auth::user()->name }}</h2>
                        <p>Gestisci le tue inserzioni</p>
                    </div>
                    <div class="button-create">
                        <a href="{{ route('flats.create') }}">
                            <button type="button" class="btn btn-dark">
                                Aggiungi appartamento
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row card-row flex-column-reverse">
                    @php
                        $userArray = array_reverse(auth()->user()->flats->toArray());
                    @endphp

                    @foreach (auth()->user()->flats as $flat)
                        <div class="card-box col-lg-12">
                            <div class="content-card row">
                                <div class="img-card col-lg-5 col-md-12">
                                    <img src="{{ asset($flat->details->image) }}" alt="Card image cap">

                                    <div class="detais-views">
                                        <div class="message" type="button" data-toggle="modal"
                                            data-target="#messageModal{{ $flat->id }}"><i class="far fa-envelope"></i>
                                        </div>
                                        <div class="chart-button" v-on:click="getChar({{ $flat->id }})" type="button"
                                            data-toggle="modal" data-target="#chartModal"><i class="fas fa-chart-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-text col-lg-6 col-md-12">
                                    <h5 class="card-title">{{ $flat->details->flat_title }}</h5>
                                    <hr>
                                    <div class="info-card">
                                        <p>{{ $flat->details->area_sqm }} Metri quadri</p>
                                        <p>{{ $flat->details->rooms_quantity }} Stanze</p>
                                        <p>{{ $flat->details->beds_quantity }} Posti letto</p>
                                        <p>{{ $flat->details->bathrooms_quantity }}
                                            @if ($flat->details->bathrooms_quantity == 1)
                                                Bagno
                                            @else
                                                Bagni
                                            @endif
                                        </p>
                                        <p>{{ $flat->details->price_day }} € a giorno</p>
                                    </div>
                                    <div class="button-container">
                                        <a href="{{ route('flats.edit', compact('flat')) }}"
                                            class="btn btn-dark">Modifica</a>
                                        <a href="{{ route('flats.show', compact('flat')) }}"
                                            class="btn btn-dark">Visualizza</a>
                                        <a href="{{ route('admin.sponsor.create', compact('flat')) }}"
                                            class="btn btn-dark">Sponsorizza</a>
                                        <button class="btn btn-dark" data-toggle="modal" data-target="#deleteModal{{ $flat->id }}"
                                            type="submit">
                                            Elimina
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $flat->id }}" aria-labelledby="exampleModalCenterTitle"
                            aria-hidden="true">
                            <div class="modal-dialog modal-delete modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mx-auto" id="exampleModalLongTitle">Sei Sicuro di voler eliminare
                                            l'appartamento?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('flats.destroy', compact('flat')) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-dark" type="submit">Elimina</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Message Modal -->
                        <div class="modal fade" id="messageModal{{ $flat->id }}"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Messaggi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <h5 class="card-header">Questo appartameno ha ricevuto i seguenti messaggi:</h5>
                                            @foreach ($flat->messages as $message)
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $message->sender_name }}
                                                        {{ $message->sender_surname }}</h5>
                                                    <p class="card-text">{{ $message->message_content }}</p>
                                                    <a href="mailto:{{ $message->sender_email }}"
                                                        class="btn btn-dark">Contatta</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Chart Modal -->
                        <div class="modal fade" id="chartModal" aria-labelledby="exampleModalCenterTitle"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Statistiche appartamento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <canvas id="chartView"></canvas>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
