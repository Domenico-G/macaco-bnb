<?php

use Illuminate\Database\Seeder;
use App\SponsorType;
use App\Service;

class SponsorServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder per tabella SponsorType
         $sponsoType = new SponsorType;
         $sponsoType->sponsor_duration = 24;
         $sponsoType->sponsor_price = 2.99;
         $sponsoType->sponsor_name = "Oro";
         $sponsoType->save();

         $sponsoType = new SponsorType;
         $sponsoType->sponsor_duration = 72;
         $sponsoType->sponsor_price = 5.99;
         $sponsoType->sponsor_name = "Platino";
         $sponsoType->save();

         $sponsoType = new SponsorType;
         $sponsoType->sponsor_duration = 144;
         $sponsoType->sponsor_price = 9.99;
         $sponsoType->sponsor_name = "Diamante";
         $sponsoType->save();

        $services = ["Wi-Fi", "Posto Macchina", "Piscina", "Sauna", "Essenziali", "Aria condizionart", "Riscaldamento", "Ingressp privato", "Tv", "Colazione", "Portinaria", "Vista Mare" ];

        // Seeder per tabella Service
        foreach($services as $serviceTag) {
            $service = new Service;
            $service->service_name = $serviceTag;
            $service->save();
        }



    }
}
