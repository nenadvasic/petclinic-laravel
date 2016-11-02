<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Requests\CreateOwnerRequest;
use App\Http\Api\V1\Requests\UpdateOwnerRequest;
use App\Http\Api\V1\Transformers\MyPetsResponse;
use App\Http\Api\V1\Transformers\OwnerForAddressResponse;
use App\Http\Api\V1\Transformers\OwnersPetsResponse;
use App\Http\Api\V1\Transformers\OwnersWithPetsResponse;
use App\Http\Api\V1\Transformers\OwnerTransformer;
use App\Http\Api\V1\Transformers\OwnerVetsResponse;
use App\Repositories\Contracts\OwnerRepositoryInterface;
use App\Services\OwnerService;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class OwnerController extends AbstractController
{
    /** @var OwnerService */
    protected $owner_service;

    /** @var OwnerRepositoryInterface */
    protected $owner_repository;

    public function __construct(OwnerService $owner_service, OwnerRepositoryInterface $owner_repository)
    {
        $this->owner_service    = $owner_service;
        $this->owner_repository = $owner_repository;
    }

    /**
     * @param int $owner_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function readOwner($owner_id)
    {
        $result = $this->owner_repository->findOrFail($owner_id);
        $dto    = fractal()->item($result, new OwnerTransformer());

        return response()->json($dto);
    }

    /**
     * @param CreateOwnerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOwner(CreateOwnerRequest $request)
    {
        $owner = $this->owner_service->createOwner($request->all());
        $dto   = fractal()->item($owner, new OwnerTransformer());

        return response()->json($dto, 201);
    }

    /**
     * @param int                $owner_id
     * @param UpdateOwnerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOwner($owner_id, UpdateOwnerRequest $request)
    {
        $owner = $this->owner_service->updateOwner($owner_id, $request->all());
        $dto   = fractal()->item($owner, new OwnerTransformer());

        return response()->json($dto);
    }

    /**
     * @param int $owner_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOwner($owner_id)
    {
        $this->owner_service->deleteOwner($owner_id);

        return response()->json(null, 204);
    }

    // ------------------------------------------------------------------------

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function allOwners(Request $request)
    {
        $this->validate($request, [
            'param' => 'required|int',
        ]);

        $result = $this->owner_repository->allOwnersPaged($request->input('param'));
        $dto    = fractal()->collection($result, new OwnerTransformer());

        return response()->json($dto);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ownersForAddress(Request $request)
    {
        $this->validate($request, [
            'address' => 'string|max:255',
        ]);

        $paginator = $this->owner_repository->ownersForAddress($request->input('address'));
        $owners    = $paginator->getCollection();

        $dto = fractal()
            ->collection($owners, new OwnerForAddressResponse())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator));

        return response()->json($dto);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ownersWithPets()
    {
        $result = $this->owner_repository->ownersWithPets();
        $dto    = fractal()->collection($result, new OwnersWithPetsResponse());

        return response()->json($dto);
    }

    /**
     * @param int $owner_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function ownersPets($owner_id)
    {
        $result = $this->owner_repository->ownersPets($owner_id);
        $dto    = fractal()->collection($result, new OwnersPetsResponse());

        return response()->json($dto);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function myPets()
    {
        $result = $this->owner_repository->myPets(auth()->user()->id);
        $dto    = fractal()->collection($result, new MyPetsResponse());

        return response()->json($dto);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ownerVets()
    {
        $result = $this->owner_repository->findOwnerVets();
        $dto    = fractal()->collection($result, new OwnerVetsResponse());

        return response()->json($dto);
    }
}
