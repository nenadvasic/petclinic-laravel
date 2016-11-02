<?php

namespace App\Repositories\Eloquent;

use App\Models\Pet;
use App\Repositories\Contracts\PetRepositoryInterface;

class PetRepository extends AbstractRepository implements PetRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Pet::class;
    }


    /**
     * @return int
     */
    public function petWithOwnerCount()
    {
        return $this->model
            ->leftJoin('owners', 'pets.owner_id', '=' , 'owners.id')
            ->count();
    }

    /**
     * @param int $owner_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function petWithOwnerForOwner($owner_id)
    {
        return $this->model
            ->leftJoin('owners', 'pets.owner_id', '=' , 'owners.id')
            ->where('owner_id', $owner_id)
            ->get();

        // return $this->model
        //     ->with('owner')
        //     ->where('owner_id', $owner_id)
        //     ->get();
    }


    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function pets()
    {
        return $this->model
            ->join('owners', 'pets.owner_id', '=', 'owners.id')
            ->join('users', 'owners.user_id', '=', 'users.id')
            ->paginate();
    }

    /**
     * @param string $pet_type
     * @return mixed
     */
    public function findPetbyType($pet_type)
    {
        return $this->findAllBy('pet_type', $pet_type);
    }
}

