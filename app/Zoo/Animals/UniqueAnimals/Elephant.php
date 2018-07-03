<?php

namespace App\Zoo\Animals\UniqueAnimals;

use App\Zoo\Animals\Animal;
use App\Zoo\Breeds\Contracts\UniqueBreedDeceasedHealth;
use App\Zoo\ZooTimeInterface;

class Elephant implements UniqueBreedDeceasedHealth
{
    const HEALTH_DECLINE = 70;
    /**
     * The number of hours that the animal's health can be in decline for before it becomes deceased
     */
    const HEALTH_DECEASED_HOURS = 1;

    /**
     * @var ZooTimeInterface
     */
    private $zooTime;

    /**
     * Elephant constructor.
     * @param ZooTimeInterface $zooTime
     */
    public function __construct(ZooTimeInterface $zooTime)
    {
        $this->zooTime = $zooTime;
    }

    public function isDeceased(Animal $animal): int
    {
        //if an elephant's health does not return above 70% once the subsequent hour has elapsed, it is pronounced dead.
        if ($animal->previous_health < static::HEALTH_DECLINE && $animal->current_health < static::HEALTH_DECLINE) {
            return true;
        }

        return false;
    }

    /**
     * When an Elephant has a health below 70% it cannot walk. If its health does not return above 70% once
     * the subsequent hour has elapsed, it is pronounced dead.
     * @param Animal $animal
     * @return string
     */
    public function getCurrentStatus(Animal $animal): string
    {
        if ($this->isDeceased($animal)) {
            return trans('animals.status.deceased');
        }

        if ($animal->current_health < static::HEALTH_DECLINE) {
            return trans('animals.status.cant_walk');
        }

        return trans('animals.status.healthy');
    }
}