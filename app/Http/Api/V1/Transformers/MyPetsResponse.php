<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Owner;

class MyPetsResponse extends AbstractTransformer
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'user',
        'pets',
    ];

    /**
     * @param Owner $owner
     * @return array
     */
    public function transform(Owner $owner)
    {
        return [
            'id'      => $owner->id,
            'address' => $owner->address,
            'city'    => $owner->city,
            // ...
        ];
    }

    /**
     * @return \League\Fractal\Resource\Collection
     */
    public function includePets(Owner $owner)
    {
        return $this->collection($owner->pets, new PetTransformer());
    }

    /**
     * @param Owner $owner
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Owner $owner)
    {
        return $this->item($owner->user, new UserTransformer());
    }
}


// [
//   {
//     "id": 1,
//     "address": "Vladimira Gortana 14",
//     "city": "Beograd",
//     "user": {
//       "id": 1,
//       "email": "nenad@umg.rs",
//       "role": "OWNER",
//       "firstName": "Nenad",
//       "lastName": "Vasic",
//       "birthdate": "2016-11-03",
//       "active": true
//     },
//     "pets": [
//       {
//         "id": 1,
//         "ownerId": 1,
//         "name": "Bady",
//         "birthdate": "2016-03-07",
//         "petType": "DOG",
//         "vaccinated": true
//       },
//       {
//         "id": 2,
//         "ownerId": 1,
//         "name": "Beki",
//         "birthdate": "2016-03-08",
//         "petType": "DOG",
//         "vaccinated": false
//       }
//     ]
//   }
// ]
