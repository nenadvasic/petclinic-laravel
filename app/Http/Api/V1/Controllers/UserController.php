<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Requests\CreateUserRequest;
use App\Http\Api\V1\Requests\UpdateUserRequest;
use App\Http\Api\V1\Requests\UserActivationSimpleDTO;
use App\Http\Api\V1\Transformers\UserTransformer;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\UserService;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class UserController extends AbstractController
{
    /** @var UserService */
    protected $user_service;

    /** @var UserRepositoryInterface */
    protected $user_repository;

    public function __construct(UserService $user_service, UserRepositoryInterface $user_repository)
    {
        $this->user_service    = $user_service;
        $this->user_repository = $user_repository;
    }

    /**
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function readUser($user_id)
    {
        $result = $this->user_repository->findOrFail($user_id);
        $dto    = fractal()->item($result, new UserTransformer());

        return response()->json($dto);
    }

    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(CreateUserRequest $request)
    {
        $user = $this->user_service->createUser($request->all());
        $dto  = fractal()->item($user, new UserTransformer());

        return response()->json($dto, 201);
    }

    /**
     * @param int               $user_id
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser($user_id, UpdateUserRequest $request)
    {
        $user = $this->user_service->updateUser($user_id, $request->all());
        $dto  = fractal()->item($user, new UserTransformer());

        return response()->json($dto);
    }

    /**
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($user_id)
    {
        $this->user_service->deleteUser($user_id);

        return response()->json(null, 204);
    }

    // ------------------------------------------------------------------------

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function users()
    {
        $paginator = $this->user_repository->paginate();
        $users     = $paginator->getCollection();

        $dto = fractal()
            ->collection($users, new UserTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator));

        return response()->json($dto);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function nonAdmins()
    {
        $result = $this->user_repository->nonAdmins();
        $dto    = fractal()->collection($result, new UserTransformer());

        return response()->json($dto);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminUsers()
    {
        $result = $this->user_repository->adminUsers();
        $dto    = fractal()->collection($result, new UserTransformer());

        return response()->json($dto);
    }


    /**
     * @param UserActivationSimpleDTO $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setUserActiveStatusSimple(UserActivationSimpleDTO $request)
    {
        return response()->json(null, 501);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveUser()
    {
        return response()->json(null, 501);
    }
}
