<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\SponsorType;

use App\Flat;

use App\Sponsor;

use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Flat $flat)
    {
        $sponsorTypes = SponsorType::all();

        if(Auth::id() != $flat->user_id){
            return redirect()->route('public.flats.show',  compact("flat"));
        }

        return view("flatsAdminView.sponsor-create", compact("sponsorTypes", "flat"));
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

        $sponsorType = SponsorType::where('id', $data["sponsor-type"])->get();
        $duration = $sponsorType[0]->sponsor_duration;

        $sponsor = new Sponsor();
        $sponsor->flat_id = $data["flat"];
        $sponsor->sponsor_type_id = $data["sponsor-type"];
        $sponsor->sponsor_end = date("Y-m-d H:i:s", strtotime(sprintf("+%d hours", $duration)));
        $sponsor->save();

        return redirect()->route('admin.dashboard');
    }
}
