<?php

namespace App\Http\Api\V1\Transformers;

use App\Models\Owner;
use App\Models\Pet;

class OwnersPetsResponse extends AbstractTransformer
{
    // ------------------------------------------------------------------------
    //
    // FIRST EXAMPLE (Owner with included Pets)
    //
    // {
    //     "id": 1,
    //     "pets": [
    //         {
    //             "id": 1,
    //             "ownerId": 1,
    //             "name": "Bady",
    //             "birthdate": "2016-03-07",
    //             "petType": "DOG",
    //             "vaccinated": true
    //         },
    //         {
    //           "id": 2,
    //           "ownerId": 1,
    //           "name": "Beki",
    //           "birthdate": "2016-03-08",
    //           "petType": "DOG",
    //           "vaccinated": false
    //         }
    //     ]
    // }
    //
    // ------------------------------------------------------------------------

    /**
     * @var array
     */
    protected $defaultIncludes = [
        'pets', // Includes can be optional
    ];

    /**
     * @param Owner $owner
     * @return array
     */
    public function transform(Owner $owner)
    {
        return [
            'id' => $owner->id,
        ];
    }

    /**
     * @return \League\Fractal\Resource\Collection
     */
    public function includePets(Owner $owner)
    {
        // We are using another transformer here for nested pets
        // PetTransformer is default for Pet but we can make something like PetTransformerSimple to output just a few columns if needed
        // To make this happen, Sifu needs to support something like this:

        // ownersPets find[
        // from Owner
        //     eloquentWith pets
        //     where Owner.id == ownerId
        //     response (OwnersPetsResponse)
        //     responseInclude (pets => PetTransformerSimple, XyzRelation => XyzTransformer, ...)
        //     secured VET, rest /owner/:ownerId/pets]

        return $this->collection($owner->pets, new PetTransformer());
    }

    // ------------------------------------------------------------------------
    //
    // SECOND EXAMPLE (listing only Pets)
    //
    // [
    //     {
    //         "id": 1,
    //         "owner_id": 1,
    //         "name": "Bady"
    //     },
    //     {
    //         "id": 2,
    //         "owner_id": 1,
    //         "name": "Beki"
    //   }
    // ]
    //
    // ------------------------------------------------------------------------

    /**
     * @param Owner $owner
     * @return array
     */
    // public function transform(Pet $pet)
    // {
    //     return [
    //         'id'       => $pet->id,
    //         'owner_id' => $pet->owner_id,
    //         'name'     => $pet->name,
    //     ];
    // }
}
