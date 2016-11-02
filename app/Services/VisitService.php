<?php

namespace App\Services;

use App\Models\Visit;
use App\Repositories\Contracts\VisitRepositoryInterface;
use Carbon\Carbon;

class VisitService extends AbstractService
{
    public function __construct(VisitRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $input_data
     * @return Visit
     */
    public function createVisit(array $input_data)
    {
        $visit_data = $this->convertInputToVisitData($input_data);

        return $this->repository->createModel($visit_data);
    }

    /**
     * @param int   $visit_id
     * @param array $input_data
     * @return Visit
     */
    public function updateVisit($visit_id, array $input_data)
    {
        $this->repository->findOrFail($visit_id);

        $visit_data = $this->convertInputToVisitData($input_data);

        return $this->repository->updateModel($visit_data, $visit_id);
    }

    /**
     * @param int $visit_id
     * @return mixed
     */
    public function deleteVisit($visit_id)
    {
        $this->repository->findOrFail($visit_id);

        return $this->repository->delete($visit_id);
    }

    /**
     * @param array $input_data
     * @return array
     */
    private function convertInputToVisitData(array $input_data)
    {
        return [
            'vet_id'       => $input_data['vetId'],
            'pet_id'       => $input_data['petId'],
            'visit_number' => $input_data['visitNumber'],
            'timestamp'    => (new Carbon($input_data['timestamp']))->toDateTimeString(),
            'pet_weight'   => isset($input_data['petWeight']) ? $input_data['petWeight'] : null,
            'description'  => isset($input_data['description']) ? $input_data['description'] : null,
            'scheduled'    => $input_data['scheduled'] ? 1 : 0,
        ];
    }

}
