<?php

namespace App\Services;

use App\Models\Pet;
use App\Repositories\Contracts\PetRepositoryInterface;
use Carbon\Carbon;

class PetService extends AbstractService
{
    public function __construct(PetRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $input_data
     * @return Pet
     */
    public function createPet(array $input_data)
    {
        $pet_data = $this->convertInputToPetData($input_data);

        return $this->repository->createModel($pet_data);
    }

    /**
     * @param int   $pet_id
     * @param array $input_data
     * @return Pet
     */
    public function updatePet($pet_id, array $input_data)
    {
        $this->repository->findOrFail($pet_id);

        $pet_data = $this->convertInputToPetData($input_data);

        return $this->repository->updateModel($pet_data, $pet_id);
    }

    /**
     * @param int $pet_id
     * @return mixed
     */
    public function deletePet($pet_id)
    {
        $this->repository->findOrFail($pet_id);

        return $this->repository->delete($pet_id);
    }

    /**
     * @param array $input_data
     * @return array
     */
    private function convertInputToPetData(array $input_data)
    {
        return [
            'owner_id'   => $input_data['ownerId'],
            'name'       => $input_data['name'],
            'birthdate'  => (new Carbon($input_data['birthdate']))->toDateString(),
            'pet_type'   => $input_data['petType'],
            'vaccinated' => $input_data['vaccinated'] ? 1 : 0,
        ];
    }

}
