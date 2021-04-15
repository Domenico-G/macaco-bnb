 <?php if (isset($edit) && !empty($edit)) {
 $method = 'PUT';
 $root = route('flat.update', compact('flat'));
 $flag = true;
 } else {
 $method = 'POST';
 $root = route('flat.store');
 $flag = false;
 } ?>

 <div class="container">
     <form action={{ $root }} method="POST" enctype="multipart/form-data">
         @csrf
         @method($method)
         <div class="form-row">
             <div class="form-group col-3">
                 <input type="text" class="form-control {{ $errors->has('street_name') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->street_name : '' }}" id="street_name" name="street_name"
                     placeholder="Indirizzo">
                 <label for="street_name">Indirizzo</label>
                 <div class="invalid-feedback">
                     Inserisci un indirizzo valido
                 </div>
             </div>
             <div class="form-group col">
                 <input type="text" class="form-control {{ $errors->has('street_number') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->street_number : '' }}" id="street_number" name="street_number"
                     placeholder="Numero civico">
                 <label for="street_number">Numero civico</label>
                 <div class="invalid-feedback">
                     Inserisci un numero civico valido
                 </div>
             </div>
             <div class="form-group col">
                 <input type="text" class="form-control {{ $errors->has('municipality') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->municipality : '' }}" id="municipality" name="municipality"
                     placeholder="Comune">
                 <label for="municipality">Comune</label>
                 <div class="invalid-feedback">
                     Inserisci un Comune valido
                 </div>
             </div>
             <div class="form-group col">
                 <input type="text"
                     class="form-control {{ $errors->has('country_secondary_subdivision') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->country_secondary_subdivision : '' }}"
                     id="country_secondary_subdivision" name="country_secondary_subdivision" placeholder="Provincia">
                 <label for="country_secondary_subdivision">Provincia</label>
                 <div class="invalid-feedback">
                     Inserisci un Comune valido
                 </div>
             </div>
             <div class="form-group col">
                 <input type="text" class="form-control {{ $errors->has('country_subdivision') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->country_subdivision : '' }}" id="country_subdivision"
                     name="country_subdivision" placeholder="Regione">
                 <label for="country_subdivision">Regione</label>
                 <div class="invalid-feedback">
                     Inserisci un Comune valido
                 </div>
             </div>
             <div class="form-group col">
                 <input type="number" class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->postal_code : '' }}" id="postal_code" name="postal_code"
                     placeholder="CAP">
                 <label for="postal_code">CAP</label>
                 <div class="invalid-feedback">
                     CAP non valido
                 </div>
             </div>
         </div>



         <div class="form-group col-12">
             <input type="text" class="form-control {{ $errors->has('flats_title') ? 'is-invalid' : '' }}"
                 value="{{ isset($flat) ? $flat->flats_title : '' }}" id="flats_title" name="flats_title"
                 placeholder="Inserisci una breve descrizione">
             <div class="invalid-feedback">
                 Inserisci una breve descrizione
             </div>
         </div>

         <div class="form-row">
             <div class="form-group col-12">
                 <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->description : '' }}" id="description" name="description"
                     placeholder="Inserisci una descrizione">
                 <div class="invalid-feedback">
                     Inserisci unadescrizione
                 </div>
             </div>


             <div class="form-group col-12">
                 <input type="text" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->image : '' }}" id="image" name="image"
                     placeholder="Inserisci un'immagine">
                 <div class="invalid-feedback">
                     Inserisci un url
                 </div>
             </div>


             <div class="form-group col-12">
                 <input type="number" class="form-control {{ $errors->has('area_sqm') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->area_sqm : '' }}" id="area_sqm" name="area_sqm"
                     placeholder="Inserisci un'immagine">
                 <div class="invalid-feedback">
                     Inserisci un numero
                 </div>
             </div>


             <div class="form-group col-12">
                 <input type="text" class="form-control {{ $errors->has('rooms_quantity') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->rooms_quantity : '' }}" id="rooms_quantity"
                     name="rooms_quantity" placeholder="Inserisci un'immagine">
                 <div class="invalid-feedback">
                     Inserisci un numero
                 </div>
             </div>


             <div class="form-group col-12">
                 <input type="text" class="form-control {{ $errors->has('beds_quantity') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->beds_quantity : '' }}" id="beds_quantity" name="beds_quantity"
                     placeholder="Inserisci un'immagine">
                 <div class="invalid-feedback">
                     Inserisci un numero
                 </div>
             </div>


             <div class="form-group col-12">
                 <input type="text" class="form-control {{ $errors->has('bathrooms_quantity') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->bathrooms_quantity : '' }}" id="bathrooms_quantity"
                     name="bathrooms_quantity" placeholder="Inserisci un'immagine">
                 <div class="invalid-feedback">
                     Inserisci un numero
                 </div>
             </div>


             <div class="form-group col-12">
                 <input type="text" class="form-control {{ $errors->has('price_day') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->price_day : '' }}" id="price_day" name="price_day"
                     placeholder="Inserisci un'immagine">
                 <div class="invalid-feedback">
                     Inserisci un numero
                 </div>
             </div>


             <div class="form-group col-12">
                 <input type="text" class="form-control {{ $errors->has('bathrooms_quantity') ? 'is-invalid' : '' }}"
                     value="{{ isset($flat) ? $flat->bathrooms_quantity : '' }}" id="bathrooms_quantity"
                     name="bathrooms_quantity" placeholder="Inserisci un'immagine">
                 <div class="invalid-feedback">
                     Inserisci un numero
                 </div>
             </div>
             <div class="form-group col-12">
                 <div class="form-check">
                     <input class="form-check-input" type="radio" name="visible" id="visible"
                     value="false">
                     <label class="form-check-label" for="visible">
                         false
                     </label>
                 </div>
                 <div class="form-check">
                     <input class="form-check-input" type="radio" name="visible" id="visible"
                         checked value="true">
                     <label class="form-check-label" for="visible">
                         true
                     </label>
                 </div>
             </div>



         </div>


         <button type="submit" class="btn btn-primary">Submit</button>



     </form>
 </div>
