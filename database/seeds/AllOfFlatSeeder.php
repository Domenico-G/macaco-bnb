<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Flat;
use App\Detail;
use App\Sponsor;
use App\FlatView;
use App\Message;



class AllOfFlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //Profilo utente registrato accessibile
        $user = new User;
        $user->name = 'Tom';
        $user->surname = 'Tom';
        $user->email = 'tom@gmail.tom';
        $user->password = '$2y$10$s9fKJyR0rAWUxK.xrQUbBe2nPgikPM4yVTOjB/jh76nmg1qlb3kqK';  // 12345678
        $user->birth = '2021-04-08';
        $user->save();

        //Primo appartamento
        $flat = new Flat;
        $flat->lat = 45.56306;
        $flat->lon = 11.55534;
        $flat->street_number = 35;
        $flat->street_name = "Via Baden-Powell";
        $flat->municipality = "Vicenza";
        $flat->country_secondary_subdivision = "Vicenza";
        $flat->country_subdivision = "Veneto";
        $flat->postal_code = 36100;
        $flat->visible = true;
        $user->flats()->save($flat);

        $details = new Detail;
        $details->flat_title = 'Lussuoso appartamento in stabile signorile';
        $details->description = '
        Bilocale di 50 mq compreso di bagno diviso da porta.
        Situato nel cuore di Vicenza, si trova in una zona tranquilla a piano terra con ingresso indipendente.
        Ttv 32" Led con Streaming, ed i migliori servizi : Wi-Fi veloce in tutta la struttura, ificatore e rinfrescatore di Aria e riscaldamento autonomo. ' . $faker->paragraph(5);
        $details->image = 'https://images.pexels.com/photos/279719/pexels-photo-279719.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260';
        $details->area_sqm = 50;
        $details->rooms_quantity = 2;
        $details->beds_quantity = 2;
        $details->price_day = 80;
        $details->bathrooms_quantity = 1;
        $flat->details()->save($details);

        $flat->services()->attach([5, 8, 1, 6, 7, 9]);

        for ($x = 0; $x < rand(2, 6); $x++) {
            $message = new Message;
            $message->sender_mail = $faker->email();
            $message->sender_name = $faker->firstName();
            $message->sender_surname = $faker->lastName();
            $message->message_content = $faker->paragraph();
            $flat->messages()->save($message);
        }


        //Secondo appartamento
        $flat = new Flat;
        $flat->lat = 45.56208;
        $flat->lon = 11.55655;
        $flat->street_number = 169;
        $flat->street_name = "Viale Astichello";
        $flat->municipality = "Vicenza";
        $flat->country_secondary_subdivision = "Vicenza";
        $flat->country_subdivision = "Veneto";
        $flat->postal_code = 36100;
        $flat->visible = true;
        $user->flats()->save($flat);

        $details = new Detail;
        $details->flat_title = 'Appartamento in palazzo storico vicino al centro';
        $details->description = '
        Locale di 100 mq compreso di bagni divisi da porta.
        Situato nel cuore di Vicenza, al terzo piano con ascensore e portineria 24h. ' . $faker->paragraph(5);
        $details->image = 'https://images.pexels.com/photos/4451937/pexels-photo-4451937.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500';
        $details->area_sqm = 100;
        $details->rooms_quantity = 3;
        $details->beds_quantity = 4;
        $details->price_day = 100;
        $details->bathrooms_quantity = 2;
        $flat->details()->save($details);

        $flat->services()->attach([5, 11]);

        for ($x = 0; $x < rand(2, 6); $x++) {
            $message = new Message;
            $message->sender_mail = $faker->email();
            $message->sender_name = $faker->firstName();
            $message->sender_surname = $faker->lastName();
            $message->message_content = $faker->paragraph();
            $flat->messages()->save($message);
        }


        //Terzo appartamento
        $flat = new Flat;
        $flat->lat = 45.55741;
        $flat->lon = 11.55605;
        $flat->street_number = 1;
        $flat->street_name = "Viale del Cimitero";
        $flat->municipality = "Vicenza";
        $flat->country_secondary_subdivision = "Vicenza";
        $flat->country_subdivision = "Veneto";
        $flat->postal_code = 36100;
        $flat->visible = true;
        $user->flats()->save($flat);

        $details = new Detail;
        $details->flat_title = 'Villetta indipendente con giardino arredato';
        $details->description = '
        Locale di 180 mq situato in zona tranquilla.
        Dotato di parcheggio privato e silenzioso giardino per un eterno riposo. ' . $faker->paragraph(5);
        $details->image = 'https://images.pexels.com/photos/1029599/pexels-photo-1029599.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260';
        $details->area_sqm = 180;
        $details->rooms_quantity = 5;
        $details->beds_quantity = 4;
        $details->price_day = 180;
        $details->bathrooms_quantity = 2;
        $flat->details()->save($details);

        $flat->services()->attach([5, 2, 4]);

        for ($x = 0; $x < rand(2, 6); $x++) {
            $message = new Message;
            $message->sender_mail = $faker->email();
            $message->sender_name = $faker->firstName();
            $message->sender_surname = $faker->lastName();
            $message->message_content = $faker->paragraph();
            $flat->messages()->save($message);
        }


        //Quarto appartamento
        $flat = new Flat;
        $flat->lat = 45.73714;
        $flat->lon = 11.65721;
        $flat->street_number = 8;
        $flat->street_name = "Via Thomas Alva Edison";
        $flat->municipality = "Marostica";
        $flat->country_secondary_subdivision = "Vicenza";
        $flat->country_subdivision = "Veneto";
        $flat->postal_code = 36063;
        $flat->visible = true;
        $user->flats()->save($flat);

        $details = new Detail;
        $details->flat_title = 'B&B in stile liberty in centro città';
        $details->description = '
        B&B di 50 mq situato in centro città.
        Dotato di piscina privata. ' . $faker->paragraph(5);
        $details->image = 'https://images.pexels.com/photos/6434634/pexels-photo-6434634.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260';
        $details->area_sqm = 50;
        $details->rooms_quantity = 1;
        $details->beds_quantity = 2;
        $details->price_day = 90;
        $details->bathrooms_quantity = 1;
        $flat->details()->save($details);

        $flat->services()->attach([5, 3, 10, 8, 11]);

        for ($x = 0; $x < rand(2, 6); $x++) {
            $message = new Message;
            $message->sender_mail = $faker->email();
            $message->sender_name = $faker->firstName();
            $message->sender_surname = $faker->lastName();
            $message->message_content = $faker->paragraph();
            $flat->messages()->save($message);
        }


        //Quinto appartamento
        $flat = new Flat;
        $flat->lat = 45.73457;
        $flat->lon = 11.65389;
        $flat->street_number = 1;
        $flat->street_name = "Via degli Scacchi";
        $flat->municipality = "Marostica";
        $flat->country_secondary_subdivision = "Vicenza";
        $flat->country_subdivision = "Veneto";
        $flat->postal_code = 36063;
        $flat->visible = true;
        $user->flats()->save($flat);

        $details = new Detail;
        $details->flat_title = 'Appartamento in centro città con vista sulla piazza principale';
        $details->description = '
        Locale di 60 mq situato in centro città. Incluso spettacolo di scacchi una volta l\'anno. ' . $faker->paragraph(5);
        $details->image = 'https://images.pexels.com/photos/1918291/pexels-photo-1918291.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260';
        $details->area_sqm = 60;
        $details->rooms_quantity = 1;
        $details->beds_quantity = 2;
        $details->price_day = 96;
        $details->bathrooms_quantity = 1;
        $flat->details()->save($details);

        $flat->services()->attach([5, 11, 6, 7, 9]);

        for ($x = 0; $x < rand(2, 6); $x++) {
            $message = new Message;
            $message->sender_mail = $faker->email();
            $message->sender_name = $faker->firstName();
            $message->sender_surname = $faker->lastName();
            $message->message_content = $faker->paragraph();
            $flat->messages()->save($message);
        }


        //Sesto appartamento
        $flat = new Flat;
        $flat->lat = 45.43735;
        $flat->lon = 12.3296;
        $flat->street_number = 1;
        $flat->street_name = "Campo San Polo";
        $flat->municipality = "Venezia";
        $flat->country_secondary_subdivision = "Venezia";
        $flat->country_subdivision = "Veneto";
        $flat->postal_code = 30125;
        $flat->visible = true;
        $user->flats()->save($flat);

        $details = new Detail;
        $details->flat_title = 'Locale tranquillo situato a Rialto';
        $details->description = '
        Locale di 73 mq situato a Rialto vicino al famoso ponte. Dotato di uscita sul canale per le barche. ' . $faker->paragraph(5);
        $details->image = 'https://images.pexels.com/photos/1653698/pexels-photo-1653698.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260';
        $details->area_sqm = 73;
        $details->rooms_quantity = 3;
        $details->beds_quantity = 2;
        $details->price_day = 52;
        $details->bathrooms_quantity = 1;
        $flat->details()->save($details);

        $flat->services()->attach([5, 12, 9, 2, 1]);

        for ($x = 0; $x < rand(2, 6); $x++) {
            $message = new Message;
            $message->sender_mail = $faker->email();
            $message->sender_name = $faker->firstName();
            $message->sender_surname = $faker->lastName();
            $message->message_content = $faker->paragraph();
            $flat->messages()->save($message);
        }


        //Settimo appartamento
        $flat = new Flat;
        $flat->lat = 45.39845;
        $flat->lon = 11.87652;
        $flat->street_number = 1;
        $flat->street_name = "Prato della Valle";
        $flat->municipality = "Padova";
        $flat->country_secondary_subdivision = "Padova";
        $flat->country_subdivision = "Veneto";
        $flat->postal_code = 35123;
        $flat->visible = true;
        $user->flats()->save($flat);

        $details = new Detail;
        $details->flat_title = 'Locale storico a Prato della Valle';
        $details->description = '
        Locale storico di 49 mq situato a Prato della Valle ottimo per turisti ed universitari ed in generale per chi vuole immergersi nel centro di padova. ' . $faker->paragraph(5);
        $details->image = 'https://images.pexels.com/photos/4513657/pexels-photo-4513657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260';
        $details->area_sqm = 49;
        $details->rooms_quantity = 2;
        $details->beds_quantity = 1;
        $details->price_day = 37;
        $details->bathrooms_quantity = 1;
        $flat->details()->save($details);

        $flat->services()->attach([5, 1, 3, 8]);

        for ($x = 0; $x < rand(2, 6); $x++) {
            $message = new Message;
            $message->sender_mail = $faker->email();
            $message->sender_name = $faker->firstName();
            $message->sender_surname = $faker->lastName();
            $message->message_content = $faker->paragraph();
            $flat->messages()->save($message);
        }




        // Altri e utenti non accessibili

        $photos = [
            'https://images.pexels.com/photos/6077367/pexels-photo-6077367.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/6444265/pexels-photo-6444265.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1080696/pexels-photo-1080696.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500',
            'https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
            'https://images.pexels.com/photos/5490356/pexels-photo-5490356.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
            'https://images.pexels.com/photos/2581922/pexels-photo-2581922.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
            'https://images.pexels.com/photos/1019980/pexels-photo-1019980.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
            'https://images.pexels.com/photos/2343465/pexels-photo-2343465.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
            'https://images.pexels.com/photos/1906795/pexels-photo-1906795.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
            'https://images.pexels.com/photos/6444268/pexels-photo-6444268.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260'
        ];

        for ($i = 0; $i < 10; $i++) {
            // Seeder per tabella Utenti
            $user = new User;
            $user->name = $faker->firstName();
            $user->surname = $faker->lastName();
            $user->email = $faker->email();
            $user->password = $faker->password();
            $user->birth = $faker->date();
            $user->save();


            // Seeder per tabella Appartamenti
            $flat = new Flat;
            $flat->lat = 45.47052 + (rand(0, 9) / 1000) ;
            $flat->lon = 9.19014 + (rand(0, 9) / 1000);
            $flat->street_number = rand(1, 50);
            $flat->street_name = "Via Duomo";
            $flat->municipality = "Milano";
            $flat->country_secondary_subdivision = "Milano";
            $flat->country_subdivision = "Lombardia";
            $flat->postal_code = 20122;
            $flat->visible = true;

            $user->flats()->save($flat);


            // Seeder per tabella Dettagli
            $details = new Detail;
            $details->flat_title = $faker->sentence();
            $details->description = $faker->paragraph();
            $details->image = $photos[rand(1, count($photos) - 1)];
            $details->area_sqm = rand(10, 150);
            $details->rooms_quantity = rand(1, 6);
            $details->beds_quantity = rand(2, 6);
            $details->price_day = rand(20, 150);
            $details->bathrooms_quantity = rand(1, 3);

            $flat->details()->save($details);


            // Seeder per tabella Sponsor
            if(rand(1, 3) == 1){
                $sponsor = new Sponsor;
                $sponsor->sponsor_end = "2022-09-14";
                $sponsor->sponsor_type_id = rand(1, 3);
                $flat->sponsor()->save($sponsor);
            }


            // Seeder per tabella Services

            $serviceArr = [];
            for ($y = 0; $y < rand(1, 5); $y++) {
                $num = rand(1, 12);
                if (!in_array($num, $serviceArr)) {
                    array_push($serviceArr, $num);
                };
            }
            $flat->services()->attach($serviceArr);
        }
    }
}
