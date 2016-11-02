<?php

namespace App\Repositories\Eloquent;

use App\Models\Vet;
use App\Repositories\Contracts\VetRepositoryInterface;

class VetRepository extends AbstractRepository implements VetRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Vet::class;
    }
}

