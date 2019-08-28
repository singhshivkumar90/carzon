<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\RoleUser;

class RoleUserRepository
{
    /**
     * @var object
     */
    protected $model;

    /**
     * Method to initialize object/variables
     *
     * @param RoleUser $model
     */
    public function __construct(RoleUser $model)
    {
        $this->model = $model;
    }
}
