<?php

namespace App\Zoo\Breeds\Contracts;

use Illuminate\Support\Collection;

interface BreedRepositoryInterface
{
    /**
     * Return all breeds
     * @return Collection|null
     */
    public function allWithAnimals();
}
