<?php

namespace App\Http\Api\V1\Controllers\Auth;

use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use App\Http\Api\V1\Requests\SignUpRequest;
use App\Http\Api\V1\Controllers\AbstractController;

class RegisterController extends AbstractController
{
    /** @var UserService */
    private $user_service;

    /**
     * @param UserService $user_service
     */
    public function __construct(UserService $user_service)
    {
        $this->middleware('guest');

        $this->user_service = $user_service;
    }

    /**
     * @param SignUpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(SignUpRequest $request)
    {
        $user = $this->user_service->emailSignUp($request->all());

        event(new Registered($user));

        // \Auth::guard()->login($user);

        return response()->json(null, 204);
    }
}
