<?php

namespace App\Zoo\Breeds;

use App\Zoo\Breeds\Contracts\BreedRepositoryInterface;

class RetrieveBreeds
{
    /**
     * @var BreedRepositoryInterface
     */
    private $breedRepo;

    /**
     * RetrieveBreeds constructor.
     * @param BreedRepositoryInterface $breedRepo
     */
    public function __construct(BreedRepositoryInterface $breedRepo)
    {
        $this->breedRepo = $breedRepo;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function all()
    {
        return $this->breedRepo->allWithAnimals();
    }
}