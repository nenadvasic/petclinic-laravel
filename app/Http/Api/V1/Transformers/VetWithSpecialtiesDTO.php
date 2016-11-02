<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Vet;

class VetWithSpecialtiesDTO extends AbstractTransformer
{
    public function transform(Vet $vet)
    {
        return [
            'id'        => $vet->id,
            'firstName' => $vet->user->first_name,
            'lastName'  => $vet->user->last_name,
            // 'specialties' => TODO
        ];
    }
}
