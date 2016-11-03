<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Owner;

class OwnerVetsResponse extends AbstractTransformer
{
    public function transform(Owner $owner)
    {
        return [
            'id'      => $owner->id,
            'userId'  => $owner->user->id,
            'address' => $owner->address,
            // ...
        ];
    }
}
