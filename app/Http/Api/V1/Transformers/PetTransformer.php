<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Pet;
use Carbon\Carbon;

class PetTransformer extends AbstractTransformer
{
    public function transform(Pet $pet)
    {
        return [
            'id'         => (int) $pet->id,
            'ownerId'    => (int) $pet->owner_id,
            'name'       => $pet->name,
            'birthdate'  => (new Carbon($pet->birthdate))->toDateString(), // Change format if needed
            'petType'    => $pet->pet_type,
            'vaccinated' => (bool) $pet->vaccinated,
        ];
    }
}
