<?php

namespace App\Http\Api\V1\Transformers;

class MyPetsResponse extends AbstractTransformer
{
    public function transform(\stdClass $row)
    {
        return [
            'id'      => $row->owner_id,
            'userId'  => $row->user_id,
            'address' => $row->address,
            'petName' => $row->name,
            'petType' => $row->pet_type,
            // ...
        ];
    }
}
