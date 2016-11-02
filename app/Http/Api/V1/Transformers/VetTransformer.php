<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Vet;

class VetTransformer extends AbstractTransformer
{
    public function transform(Vet $visit)
    {
        return [
            'id' => (int) $visit->id,
            // TODO image
        ];
    }
}
