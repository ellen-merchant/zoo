<?php

namespace App\Zoo\Animals;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Zoo\Animals\Contracts\AnimalRepositoryInterface;

class Animals implements AnimalRepositoryInterface
{
    /**
     * Return all animals
     * @return Collection|null
     */
    public function all()
    {
        return Animal::get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Animal::paginate($perPage);
    }
}
