<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Pet;

class FindPetByTypeResponse extends AbstractTransformer
{
    public function transform(Pet $pet)
    {
        return [
            'name'    => $pet->name,
            'petType' => $pet->petType,
        ];
    }
}
