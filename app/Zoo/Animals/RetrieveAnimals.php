<?php

namespace App\Zoo\Animals;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Zoo\Animals\Contracts\AnimalRepositoryInterface;

class RetrieveAnimals
{
    private $animalRepo;

    public function __construct(AnimalRepositoryInterface $animalRepo)
    {
        $this->animalRepo = $animalRepo;
    }

    /**
     * @return Collection|null
     */
    public function all()
    {
        return $this->animalRepo->all();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return $this->animalRepo->paginate();
    }
}
