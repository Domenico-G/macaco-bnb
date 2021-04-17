<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Flat;

class ApiFlatsController extends Controller
{

    public function filterFlats(Request $request)
    {

        $data = $request->all();
        $dataVar = rawurlencode($data["indirizzo"]);

        // Prima chiamata APi TomTom che ci fornisce la
        // posizione della via richiesta dall'utente

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/geocode/' . $dataVar . '.json', [
            'query' =>  [
                'key' => 'rixwtiTnqMRgKIbbjg9Jgw3IcVKqqvdG',
                'limit' => '1',
                "countryCode" => "IT"

            ],

        ]);
        $res = json_decode($response->getBody()->getContents());
        $startPosition = $res->results[0]->position->lat . "," . $res->results[0]->position->lon;


        $flats = Flat::where("visible", "=", 1)->get();

        $poiList = [];
        foreach ($flats as $flat) {
            $poi = [
                "position" => [
                    "lat" => $flat['lat'],
                    "lon" => $flat['lon']
                ],
                "id" => $flat["id"],


            ];

            array_push($poiList, $poi);
        }

        $geometryList = [
            [
                "type" => "CIRCLE",
                "position" => $startPosition,
                "radius" => 100000
            ]
        ];

        $toBody = [
            "poiList" => $poiList,
            "geometryList" => $geometryList
        ];

        $toBody = json_encode($toBody);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.tomtom.com/search/2/geometryFilter.json', [
            'headers' => ['Content-Type' => 'application/json'],

            'query' =>  ['key' => 'rixwtiTnqMRgKIbbjg9Jgw3IcVKqqvdG'],
            'body' => $toBody

        ]);

        $positions =  json_decode($response->getBody());
        $ids = [];
        foreach($positions->results as $position){
            array_push($ids, $position->id);
        };

        $filteredFlats = Flat::whereIn('id', $ids)->get();

        $arrFlats = [];
        foreach($filteredFlats as $filteredFlat){
            $filteredFlat->details;
            array_push($arrFlats, $filteredFlat);

        }

        return json_encode($arrFlats);
    }
}
