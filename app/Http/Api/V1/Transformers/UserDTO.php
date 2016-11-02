<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\User;

class UserDTO extends AbstractTransformer
{
    public function transform(User $user)
    {
        return [
            'id'        => $user->id,
            'email'     => $user->email,
            'firstName' => $user->first_name,
            'lastName'  => $user->last_name,
            'birthdate' => $user->birthdate,
            'active'    => $user->active,
        ];
    }
}
