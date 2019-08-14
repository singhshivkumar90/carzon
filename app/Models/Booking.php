<?php
declare(strict_types=1);

namespace App\Models;

class Booking extends BaseModel
{
    /**
     * Added another database connection for getting reports data
     *
     * @var string
     */
    protected $connection = 'pgsql_2';

    /**
     * Explicitly specifying table name
     *
     * @var string
     */
    protected $table = 'boeking';
}
