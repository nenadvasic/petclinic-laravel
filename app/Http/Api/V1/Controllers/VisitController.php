<?php

namespace App\Http\Api\V1\Controllers;


use App\Http\Api\V1\Requests\CreateVisitRequest;
use App\Http\Api\V1\Requests\UpdateVisitRequest;
use App\Http\Api\V1\Transformers\VisitTransformer;
use App\Repositories\Contracts\VisitRepositoryInterface;
use App\Services\VisitService;

class VisitController extends AbstractController
{
    /** @var VisitService */
    protected $visit_service;

    /** @var VisitRepositoryInterface */
    protected $visit_repository;

    public function __construct(VisitService $visit_service, VisitRepositoryInterface $visit_repository)
    {
        $this->visit_service    = $visit_service;
        $this->visit_repository = $visit_repository;

        // TODO middleware for myVisits check role OWNER
    }

    /**
     * @param int $visit_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function readVisit($visit_id)
    {
        $result = $this->visit_repository->findOrFail($visit_id);
        $dto    = fractal()->item($result, new VisitTransformer());

        return response()->json($dto);
    }

    /**
     * @param CreateVisitRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createVisit(CreateVisitRequest $request)
    {
        $visit = $this->visit_service->createVisit($request->all());
        $dto   = fractal()->item($visit, new VisitTransformer());

        return response()->json($dto, 201);
    }

    /**
     * @param int                $visit_id
     * @param UpdateVisitRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateVisit($visit_id, UpdateVisitRequest $request)
    {
        $visit = $this->visit_service->updateVisit($visit_id, $request->all());
        $dto   = fractal()->item($visit, new VisitTransformer());

        return response()->json($dto);
    }

    /**
     * @param int $visit_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteVisit($visit_id)
    {
        $this->visit_service->deleteVisit($visit_id);

        return response()->json(null, 204);
    }

    // ------------------------------------------------------------------------

    public function vetVisits()
    {

    }

    public function scheduledVisits()
    {

    }

    public function myVisits()
    {

    }

}
