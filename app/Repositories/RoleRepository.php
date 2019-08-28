<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    /**
     * @var object
     */
    protected $model;

    /**
     * Method to initialize object/variables
     *
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
