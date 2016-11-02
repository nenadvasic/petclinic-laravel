<?php

namespace App\Services;

use App\Models\Vet;
use App\Repositories\Contracts\VetRepositoryInterface;

class VetService extends AbstractService
{
    public function __construct(VetRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $input_data
     * @return Vet
     */
    public function createVet(array $input_data)
    {
        $vet_data = $this->convertInputToVetData($input_data);

        return $this->repository->createModel($vet_data);
    }

    /**
     * @param int   $vet_id
     * @param array $input_data
     * @return Vet
     */
    public function updateVet($vet_id, array $input_data)
    {
        $this->repository->findOrFail($vet_id);

        $vet_data = $this->convertInputToVetData($input_data);

        return $this->repository->updateModel($vet_data, $vet_id);
    }

    /**
     * @param int $vet_id
     * @return mixed
     */
    public function deleteVet($vet_id)
    {
        $this->repository->findOrFail($vet_id);

        return $this->repository->delete($vet_id);
    }

    /**
     * @param array $input_data
     * @return array
     */
    private function convertInputToVetData(array $input_data)
    {
        return [
            'user_id' => $input_data['userId'],
            // TODO image
        ];
    }

}
