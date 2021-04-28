 <?php if (isset($edit) && !empty($edit)) {
        $method = 'PUT';
        $root = route('flats.update', compact('flat'));
        $flag = true;
    } else {
        $method = 'POST';
        $root = route('flats.store');
        $flag = false;
    }
 ?>

 <div class="container bnb-containerForm">
    <h1>Crea un nuovo appartamento</h1>

    <h6>*(Tutti i campi sono obbligatori)</h6>

    <form action={{ $root }} method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="form-row bnb-formLocatioFlat">
            <div class="form-group col-sm-9">
                <label for="street_name">Indirizzo</label>

                <input type="text" class="form-control {{ $errors->has('street_name') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->street_name : '' }}" id="street_name" name="street_name"
                    placeholder="Indirizzo">

                <div class="invalid-feedback">
                    Inserire un indirizzo valido
                </div>
            </div>

            <div class="form-group col-sm-3">
                <label for="street_number">Numero civico</label>

                <input type="text" class="form-control {{ $errors->has('street_number') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->street_number : '' }}" id="street_number" name="street_number"
                    placeholder="Numero civico">

                <div class="invalid-feedback">
                    Inserire un numero civico valido
                </div>
            </div>
        </div>

        <div class="form-row bnb-formLocatioFlat">
            <div class="form-group col">
                <label for="municipality">Città</label>

                <input type="text" class="form-control {{ $errors->has('municipality') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->municipality : '' }}" id="municipality" name="municipality"
                    placeholder="Comune">

                <div class="invalid-feedback">
                    Inserire un nome di Città valido
                </div>
            </div>

            <div class="form-group col">
                <label for="country_secondary_subdivision">Provincia</label>

                <input type="text"
                    class="form-control {{ $errors->has('country_secondary_subdivision') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->country_secondary_subdivision : '' }}"
                    id="country_secondary_subdivision" name="country_secondary_subdivision" placeholder="Provincia">

                <div class="invalid-feedback">
                    Inserire il nome della città correttamente
                </div>
            </div>

            <div class="form-group col">
                <label for="country_subdivision">Regione</label>

                <input type="text" class="form-control {{ $errors->has('country_subdivision') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->country_subdivision : '' }}" id="country_subdivision"
                    name="country_subdivision" placeholder="Regione">

                <div class="invalid-feedback">
                    Inserire una Regione esistente
                </div>
            </div>

            <div class="form-group col">
                <label for="postal_code">CAP</label>

                <input type="number" class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->postal_code : '' }}" id="postal_code" name="postal_code"
                    placeholder="CAP">

                <div class="invalid-feedback">
                    CAP non valido
                </div>
            </div>
        </div>


        <div class="form-row bnb-formFlatDetails">
            <div class="form-group col-12">
                <label for="flat_title">Titolo descrittivo</label>

                <input type="text" class="form-control {{ $errors->has('flat_title') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->flat_title : '' }}" id="flat_title" name="flat_title"
                    placeholder="Inserisci una breve descrizione che introduca l'appartamento">

                <div class="invalid-feedback">
                    Inserire un titolo
                </div>
            </div>
        </div>

        <div class="form-row bnb-formFlatDetails">
            <div class="form-group col-12">
                <label for="description">Descrizione completa</label>

                <textarea rows="5" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" placeholder="Inserisci una descrizione completa dell'appartamento">{{ isset($flat) ? $flat->details->description : '' }}</textarea>

                <div class="invalid-feedback">
                    Inserire una descrizione
                </div>
            </div>
        </div>

        <div class="form-row bnb-formFlatDetails">
            <div class="form-group col-6">
                <label for="image">Inserisci un'immmagine rappresentativa dell'appartamento</label>

                <input type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->image : '' }}" id="image" name="image"
                    placeholder="Inserisci un'immagine">

                <div class="invalid-feedback">
                    Carica un'immagine
                </div>
            </div>
        </div>

        <div class="form-row bnb-formFlatDetails">
            <div class="form-group col-lg-3 col-sm-12">
                <label for="area_sqm"> Superfice in m&sup2;</label>

                <input type="number" class="form-control {{ $errors->has('area_sqm') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->area_sqm : '' }}" id="area_sqm" name="area_sqm"
                    placeholder="Dimensioni dell'appartamento" min="1" max="1000">

                <div class="invalid-feedback">
                    Inserisci la superfice del tuo appartamento
                </div>
            </div>


            <div class="form-group col-lg-2 col-sm-12">
                <label for="rooms_quantity">Numero di stanze</label>

                <input type="number" class="form-control {{ $errors->has('rooms_quantity') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->rooms_quantity : '' }}" id="rooms_quantity"
                    name="rooms_quantity" placeholder="Numero di stanze" min="1" max="20">

                <div class="invalid-feedback">
                    Inserisci il numero di stanze del tuo appartamento
                </div>
            </div>

            <div class="form-group col-lg-2 col-sm-12">
                <label for="beds_quantity">Numero posti letto</label>

                <input type="number" class="form-control {{ $errors->has('beds_quantity') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->beds_quantity : '' }}" id="beds_quantity" name="beds_quantity"
                    placeholder="Numero di posti letto" min="1" max="8">

                <div class="invalid-feedback">
                    Inserisci il numero di posti letto disponibili
                </div>
            </div>


            <div class="form-group col-lg-2 col-sm-12">
                <label for="bathrooms_quantity">Numero di bagni</label>

                <input type="number" class="form-control {{ $errors->has('bathrooms_quantity') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->bathrooms_quantity : '' }}" id="bathrooms_quantity"
                    name="bathrooms_quantity" placeholder="Numero di bagni" min="1" max="5">

                <div class="invalid-feedback">
                    Inserisci un numero
                </div>
            </div>


            <div class="form-group col-lg-2 col-sm-12">
                <label for="price_day">Prezzo a notte</label>

                <input type="number" class="form-control {{ $errors->has('price_day') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->price_day : '' }}" id="price_day" name="price_day"
                    placeholder="Prezzo a notte" min="15" max="400">

                <div class="invalid-feedback">
                    Inserisci il prezzo
                </div>
            </div>
        </div>

        <div class="form-row bnb-formFlatDetails">
            <div class="form-group col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="visible" id="visible"
                    @if (isset($flat) && $flat->visible === 1)
                        checked
                    @endif
                    value="1">

                    <label class="form-check-label" for="visible">
                        Rendi subito visibile l'appartamento
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="visible" id="visible"
                    @if (isset($flat) && $flat->visible === 0)
                        checked
                    @endif
                    value="0">

                    <label class="form-check-label" for="visible">
                        Tieni nascosto l'appartamento
                    </label>
                </div>
            </div>
        </div>

        <div class="form-row bnb-formFlatDetails">
            {{-- checkbox section --}}
            <div class="form-group col-12">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($services as $service)
                            <div class="col-lg-3 col-md-6 col-sm-12 form-check form-control {{ $errors->has('services') ? 'is-invalid' : '' }}" >
                                <input class="form-check-input" type="checkbox"
                                value="{{ $service->id }}"
                                @if(isset($flat))
                                    @foreach($flat->services as $activeService)
                                        @if ($activeService->id == $service->id)
                                            checked
                                        @endif
                                    @endforeach
                                @endif

                                id="checkbox-{{ $service->id }}" name="services[]" >
                                <label class="form-check-label"
                                for="checkbox-{{ $service->id }}">{{ $service->service_name }}</label>
                            </div>
                        @endforeach
                        <div class="invalid-feedback">
                            Seleziona almeno un servizio
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-dark">Invia</button>

    </form>
 </div>
