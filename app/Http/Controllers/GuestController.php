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
        $flats = Flat::all();
        return view("flatsGuestView.home", compact("flats"));
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
        return view("flatsGuestView.search", compact("services"));

    }
}
