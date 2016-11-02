<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Visit;
use Carbon\Carbon;

class VisitTransformer extends AbstractTransformer
{
    public function transform(Visit $visit)
    {
        return [
            'id'           => (int) $visit->id,
            'vetId'        => (int) $visit->vet_id,
            'petId'        => (int) $visit->pet_id,
            'visit_number' => $visit->visit_number,
            'timestamp'    => (new Carbon($visit->timestamp))->toAtomString(),
            'petWeight'    => isset($visit->pet_weight) ? (float) $visit->pet_weight : null,
            'description'  => $visit->description,
            'scheduled'    => (bool) $visit->scheduled,
        ];
    }
}
