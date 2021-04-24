<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Braintree\Transaction;

use App\SponsorType;

use App\Sponsor;

class PaymentsController extends Controller
{
    public function make(Request $request)
    {
        $sponsorTypeId = $request->input('value');

        $sponsorType = SponsorType::where('id', $sponsorTypeId)->get();

        $sponsorType = $sponsorType[0];

        $flat = $request->input('flat');

        // dd($sponsorType->sponsor_price);

        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $status = Transaction::sale([
            'amount' => $sponsorType->sponsor_price,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if($status->success){
            $duration = $sponsorType->sponsor_duration;

            $sponsor = new Sponsor();
            $sponsor->flat_id = $flat;
            $sponsor->sponsor_type_id = $sponsorTypeId;
            $sponsor->sponsor_end = date("Y-m-d H:i:s", strtotime(sprintf("+%d hours", $duration)));
            $sponsor->save();

            return response()->json($status);
        }else{
            return response()->json($status);
        }
    }
}
