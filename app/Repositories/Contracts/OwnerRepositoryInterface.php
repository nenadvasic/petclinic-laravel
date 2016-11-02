<?php

namespace App\Repositories\Contracts;

interface OwnerRepositoryInterface extends RepositoryInterface
{
    public function allOwnersPaged($param);

    public function findOwnerWithUser($id);

    public function mandatoryAddress($address);

    public function orderableOwners($order_by);

    public function deactivatedOwnerWithPets();

    public function findOwnerVets();

    public function ownersForAddress($address);

    public function ownersWithPets();

    public function ownersPets($owner_id);

    public function myPets($principal_id);
}
