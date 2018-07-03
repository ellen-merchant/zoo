<?php

namespace App\Zoo\Breeds;

use App\Zoo\Breeds\Contracts\BreedRepositoryInterface;
use Illuminate\Support\Collection;

class Breeds implements BreedRepositoryInterface
{
    /**
     * Return all breeds
     * @return Collection|null
     */
    public function allWithAnimals()
    {
        return Breed::with('animals')
            ->get();
    }
}