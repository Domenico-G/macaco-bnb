<?php

namespace App\Http\Controllers;

use App\Detail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use App\Flat;
use App\Service;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $services = Service::all();
        return view("auth.flats.create", compact("services"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $id = Auth::id();





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
        if (empty($res->results)) {
            // Creare pagine per gestione errore
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



            $detail = new Detail();
            $detail->flat_id = $flat->id;
            $detail->fill($data);
            $detail->save();

            $flat->services()->attach($services);
        }






    }

    /**
     * Display the specified resource.
     *
     * @param  Flat $flat
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return view("auth.flats.edit", compact("id"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
