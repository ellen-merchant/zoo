<?php

namespace Database\Factories;

use App\Zoo\Animals\Animal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Animal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
