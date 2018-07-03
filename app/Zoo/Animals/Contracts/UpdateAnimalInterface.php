<?php

namespace App\Zoo\Animals\Contracts;

use App\Zoo\Animals\Animal;

interface UpdateAnimalInterface
{
    public function updateHealthAndLog(
        Animal $animal,
        float $randomPercentage,
        float $healthChangePercentage,
        float $updatedHealth
    );
}
