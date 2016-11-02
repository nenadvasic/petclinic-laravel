<?php

namespace App\Services;

use App\Models\Owner;
use App\Repositories\Contracts\OwnerRepositoryInterface;

class OwnerService extends AbstractService
{
    public function __construct(OwnerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $input_data
     * @return Owner
     */
    public function createOwner(array $input_data)
    {
        $owner_data = $this->convertInputToOwnerData($input_data);

        return $this->repository->createModel($owner_data);
    }

    /**
     * @param int   $owner_id
     * @param array $input_data
     * @return Owner
     */
    public function updateOwner($owner_id, array $input_data)
    {
        $this->repository->findOrFail($owner_id);

        $owner_data = $this->convertInputToOwnerData($input_data);

        return $this->repository->updateModel($owner_data, $owner_id);
    }

    /**
     * @param int $owner_id
     * @return mixed
     */
    public function deleteOwner($owner_id)
    {
        $this->repository->findOrFail($owner_id);

        return $this->repository->delete($owner_id);
    }

    /**
     * @param array $input_data
     * @return array
     */
    private function convertInputToOwnerData(array $input_data)
    {
        return [
            'user_id'   => $input_data['userId'],
            'address'   => ! empty($input_data['address']) ? $input_data['address'] : null,
            'city'      => ! empty($input_data['city']) ? $input_data['city'] : null,
            'telephone' => ! empty($input_data['telephone']) ? $input_data['telephone'] : null,
        ];
    }
}
