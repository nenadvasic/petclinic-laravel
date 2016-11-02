<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\User;
use Carbon\Carbon;

class UserResponseDTO extends AbstractTransformer
{
    public function transform(User $user)
    {
        return [
            'id'        => (int) $user->id,
            'email'     => $user->email,
            'firstName' => $user->first_name,
            'lastName'  => $user->last_name,
            'birthdate' => $user->birthdate ? (new Carbon($user->bithdate))->toDateString() : null, // change date format if needed
            'active'    => (bool) $user->active,
        ];
    }
}
