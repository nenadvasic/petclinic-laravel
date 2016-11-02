<?php

namespace App\Repositories\Eloquent;

use App\Models\Enum\UserRole;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return User::class;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return $this->findBy('email', $email);
    }


    /**
     * @return mixed
     */
    public function adminUsers()
    {
        return $this->findAllBy('role', UserRole::ADMIN);
    }

    /**
     * @param string $first_name
     * @param string $last_name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByNameOrLastNameLike($first_name, $last_name)
    {
        return $this->model
            ->where('first_name', 'like', '%' . $first_name . '%')
            ->orWhere('last_name', 'like', '%' . $last_name . '%')
            ->get();
    }

    /**
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filterUsers($email = null, $first_name = null, $last_name = null)
    {
        return $this->model
            ->when($email, function ($query) use ($email) {
                return $query->where('email', 'like', '%' . $email . '%');
            })
            ->when($first_name, function ($query) use ($first_name) {
                return $query->where('first_name', 'like', '%' . $first_name . '%');
            })
            ->when($last_name, function ($query) use ($last_name) {
                return $query->where('last_name', 'like', '%' . $last_name . '%');
            })
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function activeUsersVets()
    {
        return $this->model
            ->join('vets', 'users.id', '=', 'vets.user_id')
            ->where('users.role', UserRole::VET)
            ->where('users.active', true)
            ->orderBy('users.last_name', 'asc')
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function nonAdmins()
    {
        return $this->model
            ->where('role', '!=', UserRole::ADMIN)
            ->get();
    }
}

