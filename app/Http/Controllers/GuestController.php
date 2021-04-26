<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Flat;
use App\FlatView;
use App\Service;

class GuestController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::where("visible", "=", 1)->get();

        $sponsoredFlats = [];

        $normalFlats = [];

        foreach($flats as $flat){
            $sponsors = $flat->sponsor;

            if (count($flat->sponsor) == 0) {
                $sponsorFlag = false;
            } else {
                if ($sponsors[count($sponsors) - 1]->sponsor_end > date('Y-m-d H:i:s')) {
                    $sponsorFlag = true;
                } else {
                    $sponsorFlag = false;
                }
            }

            if($sponsorFlag){
            array_push($sponsoredFlats, $flat);
            }else{
            array_push($normalFlats, $flat);
            }
        }

        return view("flatsGuestView.home", compact("sponsoredFlats", "normalFlats"));
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
        return view("flatsGuestView.show-flat", compact("flat"));
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

    protected function searchView(){
        $services = Service::all();

        $flats = Flat::where("visible", "=", 1)->get();

        $sponsoredFlats = [];

        foreach($flats as $flat){
            $sponsors = $flat->sponsor;

            if (count($flat->sponsor) == 0) {
                $sponsorFlag = false;
            } else {
                if ($sponsors[count($sponsors) - 1]->sponsor_end > date('Y-m-d H:i:s')) {
                    $sponsorFlag = true;
                } else {
                    $sponsorFlag = false;
                }
            }

            if($sponsorFlag){
            array_push($sponsoredFlats, $flat);
            }
        }

        return view("flatsGuestView.search", compact("services", "sponsoredFlats"));
    }
}
