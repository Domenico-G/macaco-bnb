<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Flat;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Funzione di validazione
        $this->formValidate($request);
        $data = $request->all();

        $message = new Message();
        $message->fill($data);
        $message->flat_id = $data["flat"];
        $message->save();

        $flat = $data["flat"];

        return redirect()->route('public.flats.show', compact("flat"));
    }

    protected function formValidate(Request $request)
    {
        $request->validate([
            "sender_mail" => 'required|max:319',
            "sender_name" => 'required|max:64',
            "sender_surname" => 'required|max:64',
            "message_content" => 'required',
        ]);
    }
}
