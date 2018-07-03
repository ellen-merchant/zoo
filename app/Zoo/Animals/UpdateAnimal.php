<?php

namespace App\Zoo\Animals;

use App\Zoo\Animals\Contracts\UpdateAnimalInterface;
use App\Zoo\Animals\Logs\AnimalHealthLog;
use App\Zoo\ZooTimeInterface;

class UpdateAnimal implements UpdateAnimalInterface
{
    /**
     * @var ZooTimeInterface
     */
    private $zooTime;

    /**
     * UpdateAnimal constructor.
     * @param ZooTimeInterface $zooTime
     */
    public function __construct(ZooTimeInterface $zooTime)
    {
        $this->zooTime = $zooTime;
    }

    public function updateHealthAndLog(
        Animal $animal,
        float $randomPercentage,
        float $healthChangePercentage,
        float $updatedHealth
    ) {
        $previousHealth = $animal->current_health;

        $log = new AnimalHealthLog();
        $log->animal_id = $animal->id;
        $log->previous_health = $previousHealth;
        $log->random_percentage = $randomPercentage;
        $log->health_change_percentage = $healthChangePercentage;
        $log->updated_health = $updatedHealth;
        $log->zoo_time = $this->zooTime->establishZooTime();
        $log->save();

        $this->updateHealth($animal, $updatedHealth, $previousHealth);
    }

    private function updateHealth(Animal $animal, float $health, float $previousHealth)
    {
        $animal->current_health = $health;
        if ($animal->isDeceased()) {
            $animal->current_health = Animal::HEALTH_LOWER_LIMIT;
        }
        $animal->previous_health = $previousHealth;
        $animal->save();
    }
}
