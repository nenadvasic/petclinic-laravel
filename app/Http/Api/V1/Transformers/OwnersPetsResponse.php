<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Owner;

class OwnersPetsResponse extends AbstractTransformer
{
    public function transform(Owner $owner)
    {
        return [
            'id'       => $owner->pet_id,
            'owner_id' => $owner->owner_id,
            'name'     => $owner->pet_name,
        ];
    }
}
