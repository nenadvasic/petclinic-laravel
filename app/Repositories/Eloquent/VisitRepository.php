<?php

namespace App\Repositories\Eloquent;

use App\Models\Visit;
use App\Repositories\Contracts\VisitRepositoryInterface;

class VisitRepository extends AbstractRepository implements VisitRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Visit::class;
    }

    public function vetVisits($user_id)
    {

    }

    public function scheduledVisits()
    {

    }

    public function myVisits()
    {

    }
}

