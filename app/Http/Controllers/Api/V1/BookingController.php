<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class BookingController extends BaseController
{
    /**
     * @var BookingService $bookingService
     */
    private $bookingService;

    /**
     * BookingController constructor.
     *
     * @param BookingService $bookingService
     * @return void
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Get booking count details based on criteria('day/month/week/quarter')
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        return $this->sendResponse($this->bookingService->getCount($request), Response::HTTP_OK);
    }

    /**
     * Get monthly target of booking achieved in percentage
     *
     * @return JsonResponse
     */
    public function monthlyTarget(): JsonResponse
    {
        return $this->sendResponse([
            'targetAchieved' => $this->bookingService->getMonthlyTargetAchieved()],
            Response::HTTP_OK
        );
    }
}
