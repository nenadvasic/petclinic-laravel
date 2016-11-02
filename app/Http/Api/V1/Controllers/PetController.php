<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Requests\CreatePetRequest;
use App\Http\Api\V1\Requests\UpdatePetRequest;
use App\Http\Api\V1\Transformers\FindPetByTypeResponse;
use App\Http\Api\V1\Transformers\PetTransformer;
use App\Repositories\Contracts\PetRepositoryInterface;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends AbstractController
{
    /** @var PetService */
    protected $pet_service;

    /** @var PetRepositoryInterface */
    protected $pet_repository;

    public function __construct(PetService $pet_service, PetRepositoryInterface $pet_repository)
    {
        $this->pet_service    = $pet_service;
        $this->pet_repository = $pet_repository;
    }

    /**
     * @param int $pet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function readPet($pet_id)
    {
        $result = $this->pet_repository->findOrFail($pet_id);
        $dto    = fractal()->item($result, new PetTransformer());

        return response()->json($dto);
    }

    /**
     * @param CreatePetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPet(CreatePetRequest $request)
    {
        $pet = $this->pet_service->createPet($request->all());
        $dto = fractal()->item($pet, new PetTransformer());

        return response()->json($dto, 201);
    }

    /**
     * @param int              $pet_id
     * @param UpdatePetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePet($pet_id, UpdatePetRequest $request)
    {
        $pet = $this->pet_service->updatePet($pet_id, $request->all());
        $dto = fractal()->item($pet, new PetTransformer());

        return response()->json($dto);
    }

    /**
     * @param int $pet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePet($pet_id)
    {
        $this->pet_service->deletePet($pet_id);

        return response()->json(null, 204);
    }

    // ------------------------------------------------------------------------

    public function pets()
    {
        // TODO
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findPetbyType(Request $request)
    {
        $this->validate($request, [
            'petType' => 'required|string|max:100', // TODO in enum PetType
        ]);

        $result = $this->pet_repository->findPetbyType($request->input('petType'));
        $dto    = fractal()->collection($result, new FindPetByTypeResponse());

        return response()->json($dto);
    }
}
