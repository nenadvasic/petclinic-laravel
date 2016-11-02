<?php

namespace App\Repositories\Contracts;

interface PetRepositoryInterface extends RepositoryInterface
{
    public function petWithOwnerCount();

    public function petWithOwnerForOwner($owner_id);

    public function pets();

    public function findPetbyType($pet_type);
}
