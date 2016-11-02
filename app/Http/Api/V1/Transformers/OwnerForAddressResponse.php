<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Owner;

class OwnerForAddressResponse extends AbstractTransformer
{
    public function transform(Owner $owner)
    {
        return [
            'id'        => $owner->id,
            'email'     => $owner->user->email,
            'firstName' => $owner->user->first_name,
            'lastName'  => $owner->user->last_name,
        ];
    }
}
