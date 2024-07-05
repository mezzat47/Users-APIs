<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use App\Utils\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->apiResponse($this->userService->getAllUsers(), 'success', 'Users retrieved successfully.');
    }

    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());
        return $this->apiResponse($user, 'success', 'User created successfully.', 201);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = $this->userService->getUserById($id);

        if (is_null($user)) {
            return $this->respondFailed('User not found', 404);
        }

        return $this->apiResponse($user, 'success', 'User retrieved successfully.');
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $user = $this->userService->updateUser($id, $request->validated());

        if (is_null($user)) {
            return $this->respondFailed('User not found', 404);
        }

        return $this->apiResponse($user, 'success', 'User updated successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->userService->deleteUser($id);

        if (!$deleted) {
            return $this->respondFailed('User not found', 404);
        }

        return $this->apiResponse([], 'success', 'User deleted successfully.');
    }
}
