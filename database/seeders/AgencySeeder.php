<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agency;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for ($i = 0; $i < 100000; $i++) {
            $agency = new Agency();
            $agency->ragione_sociale = $faker->company();
            $agency->indirizzo = $faker->address();
            $agency->città = $faker->city();
            $agency->codice_postale = $faker->postcode();
            $agency->provincia = $faker->state();
            $agency->regione = $faker->country();
            $agency->email = $faker->email();
            $agency->save();
        }
    }
}
