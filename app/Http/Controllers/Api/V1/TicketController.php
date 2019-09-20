<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TicketController extends BaseController
{
    /**
     * @var TicketRepository
     */
    protected $ticketRepository;

    /**
     * TicketController constructor.
     *
     * @param TicketRepository $ticketRepository
     * @return void
     */
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Show ticket count details for different time intervals
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $ticketCount = [
            'today' => $this->ticketRepository->today(),
            'yesterday' => $this->ticketRepository->yesterday(),
            'thisDayLastWeek' => $this->ticketRepository->thisDayLastWeek()
        ];

        return $this->sendResponse($ticketCount, Response::HTTP_OK);
    }
}
