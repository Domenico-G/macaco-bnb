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
      for ($i=0; $i < 10; $i++) {

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
          $flat->lat = 44.77699;
          $flat->lon = 10.88108;
          $flat->street_number = 3;
          $flat->street_name = "Via Carlo Marx";
          $flat->municipality = "Carpi";
          $flat->country_secondary_subdivision = "Modena";
          $flat->country_subdivision = "Emilia Romagna";
          $flat->postal_code = 20145;
          $flat->visible = true;

          $user->flats()->save($flat);


          // Seeder per tabella Dettagli
          $details = new Detail;
          $details->flat_title = $faker->sentence();
          $details->description = $faker->paragraph();
          $details->image = 'https://picsum.photos/seed/' . rand(1, 1000) . '/200/300';
          $details->area_sqm = rand(10, 50);
          $details->rooms_quantity = rand(4, 8);
          $details->beds_quantity = rand(2, 6);
          $details->price_day = rand(20, 900);
          $details->bathrooms_quantity = rand(1, 3);

          $flat->details()->save($details);

           // Seeder per tabella Messaggi
           for ($x=0; $x < rand(0, 4); $x++) {
               $message = new Message;
               $message->sender_mail = $faker->email();
               $message->sender_name = $faker->firstName();
               $message->sender_surname = $faker->lastName();
               $message->message_content = $faker->paragraph();
               $flat->messages()->save($message);
           }

          // Seeder per tabella Sponsor
          $sponsor = new Sponsor;
          $sponsor->sponsor_start = "2020-04-14";
          $sponsor->sponsor_end = "2020-09-14";
          $sponsor->sponsor_type_id = rand(1,3);
          $flat->sponsor()->save($sponsor);


          // Seeder per tabella FlatViews
          $flatView = new FlatView;
          $flatView->viewer_ip = $faker->ipv6();
          $flat->flatViews()->save($flatView);


          // Seeder per tabella Services

          $serviceArr = [];
          for ($y=0; $y < rand(1,5); $y++) {
              $num = rand(1, 12);
              if(!in_array($num, $serviceArr)){
                    array_push($serviceArr, $num);
              };
          }
           $flat->services()->attach($serviceArr);


      }


    }
}
