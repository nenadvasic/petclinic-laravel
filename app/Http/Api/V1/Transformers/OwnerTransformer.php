<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Owner;

class OwnerTransformer extends AbstractTransformer
{
    public function transform(Owner $owner)
    {
        return [
            'id'        => (int) $owner->id,
            'userId'    => (int) $owner->user_id,
            'address'   => $owner->address,
            'city'      => $owner->city,
            'telephone' => $owner->telephone,
        ];
    }
}
