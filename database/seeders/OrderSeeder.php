<?php
namespace Database\Seeders;

use App\Models\Order;
use App\Models\Plate;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        for($x = 0; $x < 100; $x++){

            // genera dati statici ordine
            $newOrder = new Order();
            $newOrder->name = $faker->firstName();
            $newOrder->surname = $faker->lastName();
            $newOrder->address = $faker->streetAddress();
            $newOrder->email = $faker->email();
            $newOrder->phone_number = $faker->e164PhoneNumber();
            $newOrder->total = 0;   // il prezzo viene aggiornato dopo, deve sempre avere un valore
            $newOrder->created_at = $faker->dateTimeBetween('-1 year');
            $newOrder->updated_at = $newOrder->created_at;
            $newOrder->save();  // crea entrata nella tabella ordini in modo che esista un id a cui collegare i piatti
    
            // seleziona un ristorante con piatti registrati, a caso
            $restaurantId = Restaurant::has('plates')->inRandomOrder()->first()->id;
            // prende 1-3 piatti di quel ristorante
            $plates = Plate::where('restaurant_id', $restaurantId)->inRandomOrder()->limit(rand(1,3))->get();
            // dichiara variabile per tenere traccia del totale
            $total = 0;
    
            //per ogni piatto scelto ne determina la quantitá, aggiunge un'entrata nella tabella ponte, e aggiorna il valore del totale
            foreach($plates as $plate){
                $quantity = rand(1,3);
                $newOrder->plates()->attach($plate->id, ['quantity' => $quantity]);
                $total += $plate->price * $quantity;
            }
    
            // aggiorna il totale nella tabella ordini
            $newOrder->total = $total;
            $newOrder->save();
            
        }
    }
}
