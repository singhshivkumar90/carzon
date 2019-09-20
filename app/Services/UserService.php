<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Request\CreateUserRequest;
use App\Http\Request\UpdateUserRequest;
use App\Notifications\NewUserNotification;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * @var UserRepository $userRepository
     */
    public $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create User and associated token for the application.
     *
     * @param CreateUserRequest $createUserRequest
     * @return array
     */
    public function createUser(CreateUserRequest $createUserRequest): array
    {
        $userInput = $createUserRequest->all();
        $password = $userInput['password'];
        $userInput['password'] = bcrypt($userInput['password']);
        $user = User::create($userInput);

        $user->role = $userInput['role'];
        $user->role()->attach(['role_id' => $createUserRequest->role]);

        $user->notify(new NewUserNotification($password));

        return [
            'user' => $user
        ];
    }

    /**
     * Update the user details
     *
     * @param UpdateUserRequest $request
     * @param int $userId
     * @return mixed
     */
    public function updateUser(UpdateUserRequest $request, int $userId)
    {
        $inputData = $request->all();

        return $this->userRepository->update($userId, $inputData);
    }

    /**
     * Get all user list
     *
     * @return LengthAwarePaginator
     */
    public function getAllUserList(): LengthAwarePaginator
    {
        $userList = $this->userRepository->getUserList();

        return $userList;
    }
}
