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
        $address = rawurlencode($data["address"]);
        $distanceM = $data["distanceKm"] * 1000;
        $roomsNumber = $data["roomsNumber"];
        $bedsNumber = $data["bedsNumber"];
        $servicesId = explode(",", $data["checkedServices"]);

        // Prima chiamata APi TomTom che ci fornisce la
        // posizione della via richiesta dall'utente

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/geocode/' . $address . '.json', [
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
                "radius" => $distanceM
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

        $normalFlats = [];
        $sponsoredFlats = [];

        foreach($filteredFlats as $filteredFlat){
            $details = $filteredFlat->details;
            $bedsQuantity = $details->beds_quantity;
            $roomsQuantity = $details->rooms_quantity;
            $services = $filteredFlat->services;
            $foundServicesCounter = 0;
            $servicesFlag = false;

            if($servicesId[0] === ""){
                $servicesFlag = true;
            }else{
                foreach($services as $service){
                    if(in_array($service->id, $servicesId)){
                        $foundServicesCounter += 1;
                    }

                    if($foundServicesCounter === count($servicesId)){
                        $servicesFlag = true;
                    }
                }
            }

            $sponsors = $filteredFlat->sponsor;

            if (count($filteredFlat->sponsor) == 0) {
                $sponsorFlag = false;
            } else {
                if ($sponsors[count($sponsors) - 1]->sponsor_end > date('Y-m-d H:i:s')) {
                    $sponsorFlag = true;
                } else {
                    $sponsorFlag = false;
                }
            }

            if ($bedsQuantity >= $bedsNumber && $roomsQuantity >= $roomsNumber && $servicesFlag) {
                if($sponsorFlag){
                array_push($sponsoredFlats, $filteredFlat);

                }
                array_push($normalFlats, $filteredFlat);
            }
        };

        $arrFlats = [
            "sponsoreds"=>$sponsoredFlats,
            "normals"=>$normalFlats
        ];

        return json_encode($arrFlats);
    }

    public function viewsFlat(Request $request){
        $data = $request->all();
        $id = $data["id"];
        $flats = Flat::where("user_id", "=", $id)->get();

        $viewsArr = [];
        foreach($flats as $flat){
            foreach($flat->flatViews as $view){
                array_push($viewsArr, $view);
            }
        };

        $messagesArr = [];
        foreach ($flats as $flat) {
            foreach ($flat->messages as $message) {
                array_push($messagesArr, $message);
            }
        };

        $allViewsArr = [];
        array_push($allViewsArr, $messagesArr);
        array_push($allViewsArr, $viewsArr);


        return json_encode($allViewsArr);
    }
}
