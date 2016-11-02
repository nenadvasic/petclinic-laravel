<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Requests\CreateVetRequest;
use App\Http\Api\V1\Requests\UpdateVetRequest;
use App\Http\Api\V1\Requests\VetDTO;
use App\Http\Api\V1\Transformers\VetTransformer;
use App\Repositories\Contracts\VetRepositoryInterface;
use App\Services\VetService;

class VetController extends AbstractController
{
    /** @var VetService */
    protected $vet_service;

    /** @var VetRepositoryInterface */
    protected $vet_repository;

    public function __construct(VetService $vet_service, VetRepositoryInterface $vet_repository)
    {
        $this->vet_service    = $vet_service;
        $this->vet_repository = $vet_repository;
    }

    /**
     * @param int $vet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function readVet($vet_id)
    {
        $result = $this->vet_repository->findOrFail($vet_id);
        $dto    = fractal()->item($result, new VetTransformer());

        return response()->json($dto, 201);
    }

    /**
     * @param CreateVetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createVet(CreateVetRequest $request)
    {
        $vet = $this->vet_service->createVet($request->all());
        $dto = fractal()->item($vet, new VetTransformer());

        return response()->json($dto);
    }

    /**
     * @param int              $vet_id
     * @param UpdateVetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateVet($vet_id, UpdateVetRequest $request)
    {
        $vet = $this->vet_service->updateVet($vet_id, $request->all());
        $dto = fractal()->item($vet, new VetTransformer());

        return response()->json($dto);
    }

    /**
     * @param int $vet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteVet($vet_id)
    {
        $this->vet_service->deleteVet($vet_id);

        return response()->json(null, 204);
    }

    // ------------------------------------------------------------------------

    public function vetsWithSpecialties(VetDTO $request)
    {
        // TODO
    }

    public function vetInfo()
    {
        // TODO
    }
}
