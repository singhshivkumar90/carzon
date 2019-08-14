<?php
declare(strict_types=1);

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
    /**
     * Class constants.
     */
    const EMPLOYEE = 'Employee';

    /**
     * @return BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 'role_users', 'role_id', 'user_id'
        );
    }
}
