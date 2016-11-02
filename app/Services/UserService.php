<?php

namespace App\Services;

use App\Models\Enum\UserRole;
use App\Repositories\Contracts\UserRepositoryInterface;
use Auth;
use App\Models\User;
use Carbon\Carbon;

class UserService extends AbstractService
{
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $input_data
     * @return User
     */
    public function createUser(array $input_data)
    {
        $user_data = $this->convertInputToUserData($input_data);

        return $this->repository->createModel($user_data);
    }

    /**
     * @param int   $user_id
     * @param array $input_data
     * @return User
     */
    public function updateUser($user_id, array $input_data)
    {
        $this->repository->findOrFail($user_id);

        $user_data = $this->convertInputToUserData($input_data);

        return $this->repository->updateModel($user_data, $user_id);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function deleteUser($user_id)
    {
        $this->repository->findOrFail($user_id);

        return $this->repository->delete($user_id);
    }

    /**
     * @param array $input_data
     * @return array
     */
    private function convertInputToUserData(array $input_data)
    {
        return [
            'email'      => $input_data['email'],
            'password'   => bcrypt($input_data['password']),
            'role'       => $input_data['role'],
            'first_name' => $input_data['firstName'],
            'last_name'  => $input_data['lastName'],
            'birthdate'  => (new Carbon($input_data['birthdate']))->toDateString(),
            'active'     => $input_data['active'] ? 1 : 0,
        ];
    }

    /**
     * @param array $input_data
     * @return User
     */
    public function emailSignUp(array $input_data)
    {
        // Default user role
        $input_data['role'] = UserRole::VET;

        return $this->createUser($input_data);
    }

    /**
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function emailSignIn($email, $password)
    {
        return Auth::guard()->attempt(['email' => $email, 'password' => $password]);
    }
}
