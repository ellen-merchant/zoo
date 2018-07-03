<?php

use App\Zoo\Animals\Animal;
use Illuminate\Database\Seeder;

class AnimalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Animal::class, 5)->create([
            'breed_id' => 1,
        ]);
        factory(Animal::class, 5)->create([
            'breed_id' => 2,
        ]);
        factory(Animal::class, 5)->create([
            'breed_id' => 3,
        ]);
    }
}
