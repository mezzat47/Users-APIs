<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Utils\ApiResponseTrait;
use App\Utils\Constants;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $loginResult = $this->authService->login($credentials['email'], $credentials['password']);

        if ($loginResult) {
            return $this->apiResponse(
                [
                    'user' => $loginResult['user'],
                    'token' => $loginResult['token'],
                ],
                Constants::$API_STATUS_SUCCESS,
                'Successfully authenticated',
                200,
                true
            );
        }

        return $this->respondFailed('Failed to authenticate.', 401);
    }


    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $userData = $request->validated();
        $registrationResult = $this->authService->register($userData);

        if ($registrationResult) {
            return $this->apiResponse(
                [
                    'user' => $registrationResult['user'],
                    'token' => $registrationResult['token'],
                ],
                Constants::$API_STATUS_SUCCESS,
                'User has been registered successfully.',
                201,
                true
            );
        }

        return $this->respondFailed('Failed to register user.', 400);
    }


    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        if ($this->authService->logout()) {
            return $this->respondSuccess('Logged out successfully.');
        }

        return $this->respondFailed('Failed to logout.');
    }
}
