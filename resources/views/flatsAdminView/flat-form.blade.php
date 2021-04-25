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
    <form action={{ $root }} method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="form-row bnb-formLocatioFlat">
            <div class="form-group col-3">
                <label for="street_name">Indirizzo</label>

                <input type="text" class="form-control {{ $errors->has('street_name') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->street_name : '' }}" id="street_name" name="street_name"
                    placeholder="Indirizzo">

                <div class="invalid-feedback">
                    Inserire un indirizzo valido
                </div>
            </div>

            <div class="form-group col">
                <label for="street_number">Numero civico</label>

                <input type="text" class="form-control {{ $errors->has('street_number') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->street_number : '' }}" id="street_number" name="street_number"
                    placeholder="Numero civico">

                <div class="invalid-feedback">
                    Inserire un numero civico valido
                </div>
            </div>

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
                <input type="text" class="form-control {{ $errors->has('flat_title') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->flat_title : '' }}" id="flat_title" name="flat_title"
                    placeholder="Inserisci una breve descrizione che introduca l'appartamento">
                <div class="invalid-feedback">
                    Inserire una breve descrizione
                </div>
            </div>

            <div class="form-group col-12">
                <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->description : '' }}" id="description" name="description"
                    placeholder="Inserisci una descrizione completa dell'appartamento">
                <div class="invalid-feedback">
                    Inserire una descrizione
                </div>
            </div>


            <div class="form-group col-12">
                <input type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->image : '' }}" id="image" name="image"
                    placeholder="Inserisci un'immagine">
                <div class="invalid-feedback">
                    Carica un'immagine
                </div>
            </div>


            <div class="form-group col-12">
                <input type="number" min="1" class="form-control {{ $errors->has('area_sqm') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->area_sqm : '' }}" id="area_sqm" name="area_sqm"
                    placeholder="Inserisci le dimensioni dell'appartamento in metri quadri">
                <div class="invalid-feedback">
                    Inserisci un numero
                </div>
            </div>


            <div class="form-group col-12">
                <input type="number"  min="1" class="form-control {{ $errors->has('rooms_quantity') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->rooms_quantity : '' }}" id="rooms_quantity"
                    name="rooms_quantity" placeholder="Inserisci il numero delle stanze ">
                <div class="invalid-feedback">
                    Inserisci un numero
                </div>
            </div>


            <div class="form-group col-12">
                <input type="number"  min="1" class="form-control {{ $errors->has('beds_quantity') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->beds_quantity : '' }}" id="beds_quantity" name="beds_quantity"
                    placeholder="Iinserisci in numero dei posti letto disponibili">
                <div class="invalid-feedback">
                    Inserisci un numero
                </div>
            </div>


            <div class="form-group col-12">
                <input type="number"  min="1" class="form-control {{ $errors->has('bathrooms_quantity') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->bathrooms_quantity : '' }}" id="bathrooms_quantity"
                    name="bathrooms_quantity" placeholder="Inserisci il numero dei bagno disponibili">
                <div class="invalid-feedback">
                    Inserisci un numero
                </div>
            </div>


            <div class="form-group col-12">
                <input type="number"  min="1" class="form-control {{ $errors->has('price_day') ? 'is-invalid' : '' }}"
                    value="{{ isset($flat) ? $flat->details->price_day : '' }}" id="price_day" name="price_day"
                    placeholder="Inserici il prezzo per giorno">
                <div class="invalid-feedback">
                    Inserisci un numero
                </div>
            </div>

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
