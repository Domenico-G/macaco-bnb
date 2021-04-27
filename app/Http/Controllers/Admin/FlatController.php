<?php

namespace App\Http\Controllers\Admin;

use App\Detail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use App\Flat;
use App\Service;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use App\FlatView;


class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::all();

        return redirect()->route('public.flats.home', compact("flats"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view("flatsAdminView.create", compact("services"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Funzioni di validazione
        $this->formValidate($request);

        $request->validate([
            'image' => 'required'
        ]);

        $data = $request->all();
        $id = Auth::id();

        $res = $this->tomtomCall($data);

        if (empty($res->results)) {
            //TODO Creare pagine per gestione errore
            return "caso";
        } else {
            $services = $data["services"];
            $lat = $res->results[0]->position->lat;
            $lon = $res->results[0]->position->lon;
            $flat = new Flat();
            $flat->fill($data);
            $flat->lat = $lat;
            $flat->lon = $lon;
            $flat->user_id = $id;
            $flat->save();

            $path = $request->file("image")->store("public");

            $detail = new Detail();
            $detail->flat_id = $flat->id;
            $detail->image = $path;
            $detail->fill($data);
            $detail->save();

            $flat->services()->attach($services);

            return redirect()->route('public.flats.show', compact("flat"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Flat $flat
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat , Request $request)
    {
        $this->getViews($request , $flat->id);

        return redirect()->route('public.flats.show',  compact("flat"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Flat $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(Flat $flat)
    {
        $services = Service::All();
        $detail = Detail::All();
        return view("flatsAdminView.edit", compact("flat", "detail", "services"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Flat $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    {
        // Funzione di validazione
        $this->formValidate($request);

        $data = $request->all();
        $services = $data["services"];

        $res = $this->tomtomCall($data);

        if (empty($res->results)) {
            //TODO Creare pagine per gestione errore
            return "caso";
        } else {
        $lat = $res->results[0]->position->lat;
        $lon = $res->results[0]->position->lon;
        $flat->lat = $lat;
        $flat->lon = $lon;
        $flat->save();
        $flat->update($data);

        if($request->file("image") == null){
            $path = $flat->details->image;
        }else{
            $path = $request->file("image")->store("public");
        }

        $flat->details->image = $path;
        $flat->details->update($data);
        $flat->services()->sync($services);

        return redirect()->route("public.flats.show", compact("flat"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Flat $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        $flatViews = $flat->flatViews;
        foreach($flatViews as $flatView){
            $flatView->delete();
        }
        $messages = $flat->messages;
        foreach($messages as $message){
            $message->delete();
        }
        $sponsors = $flat->sponsor;
        foreach($sponsors as $sponsor){
            $sponsor->delete();
        }
        $flat->details->delete();
        $flat->services()->detach($flat->services);
        $flat->delete();
        return redirect()->route("admin.dashboard");
    }


    protected function tomtomCall($data)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/structuredGeocode.json', [
            'query' => [
                'key' => 'rixwtiTnqMRgKIbbjg9Jgw3IcVKqqvdG', //api key
                'countryCode' => 'IT',
                'limit' => '1',
                'streetNumber' => $data["street_number"],
                'streetName' => $data["street_name"],
                'municipality' => $data["municipality"],
                'countrySecondarySubdivision' => $data["country_secondary_subdivision"],
                'countrySubdivision' => $data["country_subdivision"],
                'postalCode' => $data["postal_code"],
            ]
        ]);
        $res = json_decode($response->getBody()->getContents());
        return $res;
    }

    protected function formValidate(Request $request)
    {
        $request->validate([
            "street_number" => 'required|max:8',
            "street_name" => 'required',
            "municipality" => 'required',
            "country_secondary_subdivision" => 'required',
            "country_subdivision" => 'required',
            "postal_code" => 'required|max:8',
            "flat_title" => 'required',
            "description" => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "area_sqm" => 'required|numeric',
            "rooms_quantity" => 'required|numeric',
            "beds_quantity" => 'required|numeric',
            "bathrooms_quantity" => 'required|numeric',
            "price_day" => 'required|numeric',
            "visible" => 'required|boolean',
            "services" => 'required'
        ]);
    }

    protected function getViews(Request $request , $id){
        $ip = $request->getClientIp();
        $view = new FlatView();
        $view->flat_id = $id;
        $view->viewer_ip = $ip;
        $viewsRecord = FlatView::where('flat_id', '=', $id)->where('viewer_ip', '=', $ip)->count();
        if($viewsRecord == 0){
            $view->save();
        }

    }
}
