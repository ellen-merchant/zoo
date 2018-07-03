<?php

namespace App\Zoo\Animals\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AnimalRepositoryInterface
{
    /**
     * Return all animals
     * @return Collection|null
     */
    public function all();

    /**
     * Return animals with pagination
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;
}
