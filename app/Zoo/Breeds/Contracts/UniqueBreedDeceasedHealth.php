<?php

namespace App\Zoo\Breeds\Contracts;

use App\Zoo\Animals\Animal;

interface UniqueBreedDeceasedHealth
{
    public function isDeceased(Animal $animal): int;

    public function getCurrentStatus(Animal $animal): string;
}