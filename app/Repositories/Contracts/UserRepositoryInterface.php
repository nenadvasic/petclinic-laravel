<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByEmail($email);

    public function adminUsers();

    public function findByNameOrLastNameLike($first_name, $last_name);

    public function filterUsers($email = null, $first_name = null, $last_name = null);

    public function activeUsersVets();

    public function nonAdmins();
}
