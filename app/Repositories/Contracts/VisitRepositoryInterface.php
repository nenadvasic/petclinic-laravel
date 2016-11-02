<?php

namespace App\Repositories\Contracts;

interface VisitRepositoryInterface extends RepositoryInterface
{
    public function vetVisits($user_id);

    public function myVisits();

    public function scheduledVisits();
}
