<?php
declare(strict_types=1);

namespace App\Models;

class ToDo extends BaseModel
{
    /**
     * Explicitly specifying table name
     *
     * @var string
     */
    protected $table = 'todos';
}
