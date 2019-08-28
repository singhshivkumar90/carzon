<?php
declare(strict_types=1);

namespace App\Models;

class RoleUser extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role_id'];
}
