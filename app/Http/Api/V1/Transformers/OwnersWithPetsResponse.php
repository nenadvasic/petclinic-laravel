<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Owner;

class OwnersWithPetsResponse extends AbstractTransformer
{
    public function transform(Owner $owner)
    {
        return [
            'firstName' => $owner->user->first_name,
            'lastName'  => $owner->user->last_name,
        ];
    }
}
