<?php

namespace App\Http\Api\V1\Controllers\Auth;

use App\Services\UserService;
use App\Http\Api\V1\Requests\SignInRequest;
use App\Http\Api\V1\Controllers\AbstractController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends AbstractController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /** @var UserService */
    private $user_service;

    /**
     * @param UserService $user_service
     */
    public function __construct(UserService $user_service)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->user_service = $user_service;
    }

    /**
     * @param SignInRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login(SignInRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $email    = $request->input('email');
        $password = $request->input('password');

        if ($token = $this->user_service->emailSignIn($email, $password)) {
            return $this->sendLoginResponse($request, $token);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param SignInRequest $request
     * @param string        $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(SignInRequest $request, $token)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user(), $token);
    }

    /**
     * @param SignInRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFailedLoginResponse(SignInRequest $request)
    {
        return response()->json(['error' => \Lang::get('auth.failed')], 401);
    }

    /**
     * @param SignInRequest $request
     * @param mixed         $user
     * @param string        $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticated(SignInRequest $request, $user, $token)
    {
        // TODO refresh token ?

        return response()->json([
            'accessToken' => $token,
            // 'access_token' => $token,
            // 'token_type'   => 'bearer',
            // 'expires_in'   => \Config::get('jwt.ttl') * 60,
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $this->guard()->logout(); // pass true to blacklist forever
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return response()->json(null, 204);
    }

    public function resetPassword()
    {
        // TODO
    }

    public function verifyEmail()
    {
        // TODO
    }

    public function changePassword()
    {
        // TODO
    }
}
