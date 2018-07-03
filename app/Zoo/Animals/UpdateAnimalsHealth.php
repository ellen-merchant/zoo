<?php

namespace App\Zoo\Animals;

use App\Zoo\Animals\Contracts\UpdateAnimalInterface;
use App\Zoo\Breeds\RetrieveBreeds;
use Illuminate\Support\Facades\Log;

class UpdateAnimalsHealth
{
    const REDUCE_HEALTH_MIN = 0;
    const REDUCE_HEALTH_MAX = 20;
    const INCREASE_HEALTH_MIN = 10;
    const INCREASE_HEALTH_MAX = 25;

    /**
     * @var RetrieveAnimals
     */
    private $retrieveAnimals;
    /**
     * @var UpdateAnimalInterface
     */
    private $updateAnimal;
    /**
     * @var RetrieveBreeds
     */
    private $retrieveBreeds;

    /**
     * ReduceAllAnimalsHealth constructor.
     * @param RetrieveAnimals $retrieveAnimals
     * @param UpdateAnimalInterface $updateAnimal
     * @param RetrieveBreeds $retrieveBreeds
     */
    public function __construct(
        RetrieveAnimals $retrieveAnimals,
        UpdateAnimalInterface $updateAnimal,
        RetrieveBreeds $retrieveBreeds
    ) {
        $this->retrieveAnimals = $retrieveAnimals;
        $this->updateAnimal = $updateAnimal;
        $this->retrieveBreeds = $retrieveBreeds;
    }

    /**
     * Reduce each animal's health by a random percentage of their current health.
     */
    public function reduce()
    {
        $animals = $this->retrieveAnimals->all();

        if (!$animals) {
            Log::info('No animals found');
            return;
        }

        $scale = pow(100, config('animals.current-health-decimal-points'));

        foreach ($animals as $animal) {
            /* @var $animal Animal */

            //calculate the percentage of health reduction based on the animals current health
            $randomPercentage = mt_rand(static::REDUCE_HEALTH_MIN * $scale,
                    static::REDUCE_HEALTH_MAX * $scale) / $scale;
            $healthChangePercentage = $this->calculatePercentage($animal->current_health, $randomPercentage);
            $reducedHealth = $animal->current_health - $healthChangePercentage;

            $this->updateAnimal->updateHealthAndLog($animal, $randomPercentage, $healthChangePercentage,
                $reducedHealth);
        }
    }

    /**
     * Increase the health of each animal by the same percentage depending on their breeds.
     * The health of the respective animals is to be increased by the specified
     * percentage of their current health. Health should be capped at 100%.
     */
    public function increase()
    {
        $breeds = $this->retrieveBreeds->all();

        if (!$breeds) {
            Log::info('No breeds found');
            return;
        }

        foreach ($breeds as $breed) {

            $randomBreedPercentage = mt_rand(static::INCREASE_HEALTH_MIN, static::INCREASE_HEALTH_MAX);

            foreach ($breed->animals as $animal) {
                /* @var $animal Animal */

                if ($animal->hasFullHealth()) {
                    continue;
                }

                //calculate the percentage of health increase based on the animals current health and the breed percentage
                $healthChangePercentage = $this->calculatePercentage($animal->current_health, $randomBreedPercentage);
                $increasedHealth = $animal->current_health + $healthChangePercentage;

                $this->updateAnimal->updateHealthAndLog($animal, $randomBreedPercentage, $healthChangePercentage,
                    $increasedHealth);
            }
        }
    }

    private function calculatePercentage($currentHealth, $percentage)
    {
        return ($currentHealth / 100) * $percentage;
    }
}