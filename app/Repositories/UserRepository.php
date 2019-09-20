<?php
declare(strict_types=1);

namespace App\Repositories;

use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends Repository
{
    /**
     * Class constant
     */
    private const SUPER_ADMIN_ID = 3;

    /**
     * @var object
     */
    protected $model;

    /**
     * Method to initialize object/variables
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Update model with given attributes
     *
     * @param int $id
     * @param array $attributes
     * @return boolean
     */
    public function update(int $id, array $attributes)
    {
        unset($attributes['password']);

        $user = $this->find($id);
        $isUserUpdate = $user->update($attributes);

        if ($isUserUpdate) {
            $user->role()->sync(['role_id' => $attributes['role']]);
        }

        return $isUserUpdate;
    }

    /**
     * Get all user list
     *
     * @return LengthAwarePaginator
     */
    public function getUserList(): LengthAwarePaginator
    {
        $query =  User::with('role')->whereHas('role', function($query) {
            $query->where('roles.id', '!=', self::SUPER_ADMIN_ID);
        });

        $userList = $query->orderByDesc('updated_at')->paginate(config('constants.PER_PAGE'));

        return $userList;
    }
}
