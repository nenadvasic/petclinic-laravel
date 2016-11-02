<?php

namespace App\Repositories\Eloquent;

use App\Models\Enum\UserRole;
use App\Models\Owner;
use App\Repositories\Contracts\OwnerRepositoryInterface;

class OwnerRepository extends AbstractRepository implements OwnerRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Owner::class;
    }

    /**
     * @param int $param
     * @return mixed
     */
    public function allOwnersPaged($param)
    {
        return $this->model->offset($param)->limit(20)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOwnerWithUser($id)
    {
        return $this->model
            ->join('users', 'owners.user_id', '=', 'users.id')
            ->where('owners.id', $id)
            ->first();
    }

    /**
     * @param string $address
     * @return mixed
     */
    public function mandatoryAddress($address)
    {
        return $this->findAllBy('address', $address);
    }


    /**
     * @param string $order_by
     * @return \Illuminate\Support\Collection
     */
    public function orderableOwners($order_by)
    {
        return $this->model
            ->whereNotNull('city')
            ->orWhereNotNull('telephone')
            ->when($order_by, function ($query) use ($order_by) {
                return $query->orderBy($order_by);
            })->get();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function deactivatedOwnerWithPets()
    {
        return $this->model
            ->join('pets', 'owners.id', '=', 'pets.owner_id')
            ->join('users', 'owners.user_id', '=', 'users.id')
            ->where('users.active', 0)
            ->where('users.role', UserRole::OWNER)
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findOwnerVets()
    {
        // return $this->model
        return \DB::table('owners')
            ->join('users', 'owners.user_id', '=', 'users.id')
            ->where('users.role', UserRole::VET)
            ->get();
    }

    /**
     * @param string $address
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function ownersForAddress($address)
    {
        return $this->model
            ->with('user')
            ->when($address, function ($query) use ($address) {
                return $query->where('address', 'like', '%' . $address . '%');
            })
            ->paginate();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ownersWithPets()
    {
        return $this->model
            ->join('pets', 'owners.id', '=', 'pets.owner_id')
            ->join('users', 'owners.user_id', '=', 'users.id')
            ->with('user')
            ->get();
    }

    /**
     * @param int $owner_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ownersPets($owner_id)
    {
        return $this->model
            ->selectRaw('pets.id as pet_id, owners.id as owner_id, pets.name as pet_name')
            ->join('pets', 'owners.id', '=', 'pets.owner_id')
            ->join('users', 'owners.user_id', '=', 'users.id')
            ->where('owners.id', $owner_id)
            ->get();
    }

    /**
     * @param $principal_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function myPets($principal_id)
    {
        // return $this->model
        return \DB::table('owners')
            ->join('pets', 'owners.id', '=', 'pets.owner_id')
            ->join('users', 'owners.user_id', '=', 'users.id')
            ->where('owners.user_id', $principal_id)
            ->get();
    }

}

