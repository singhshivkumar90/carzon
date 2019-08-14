<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Ticket;
use App\Traits\Reports;

class TicketRepository extends Repository
{
    use Reports;

    /**
     * To initialize class object/variables
     *
     * @param Ticket $model
     */
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }
}
