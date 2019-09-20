<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Facades\UserDetails;
use App\Http\Request\CreateUserRequest;
use App\Http\Request\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Services\UserService;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    /**
     * @var UserService $userService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get the logged in user details
     *
     * @return JsonResponse
     */
    public function loggedInUser(): JsonResponse
    {
        $userDetails = UserDetails::getLoggedInUserAndRole();

        return $this->sendResponse(
            ['user' => $userDetails['user'], 'role' => $userDetails['role']],Response::HTTP_OK, trans('user.success')
        );
    }

    /**
     * Get the user by id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $data = new UserResource($user);

        return $this->sendResponse($data,Response::HTTP_OK, trans('user.success'));
    }

    /**
     * Show all of the users for the application.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $userList = $this->userService->getAllUserList();
        $users = new UserResourceCollection($userList);

        return $this->sendResponse($users,Response::HTTP_OK, trans('user.success'));
    }

    /**
     * Create user for the application
     *
     * @param CreateUserRequest $userRequest
     * @return JsonResponse
     */
    public function store(CreateUserRequest $userRequest): JsonResponse
    {
        $userDetails = $this->userService->createUser($userRequest);

        return $this->sendResponse($userDetails, Response::HTTP_OK, trans('user.create_success'));
    }

    /**
     * Update user details
     *
     * @param UpdateUserRequest $updateUserRequest
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $updateUserRequest, int $id): JsonResponse
    {
        $this->userService->updateUser($updateUserRequest, $id);

        return $this->sendResponse(
            [], Response::HTTP_OK, trans('user.update_success')
        );
    }

    /**
     * Delete user based on id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {

        User::findOrFail($id)->delete();

        return $this->sendResponse(
            [], Response::HTTP_OK, trans('user.delete_success')
        );
    }
}
