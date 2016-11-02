<?php

namespace App\Http\Api\V1\Transformers;

class OwnerVetsResponse extends AbstractTransformer
{
    public function transform(\stdClass $row)
    {
        return [
            'id'      => $row->id,
            'userId'  => $row->user_id,
            'address' => $row->address,
            // ...
        ];
    }
}
