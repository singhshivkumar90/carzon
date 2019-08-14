<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\ChannelPerformanceResource;
use App\Services\BookingService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ChannelPerformanceController extends BaseController
{
    /**
     * @var BookingService $bookingService
     */
    private $bookingService;

    /**
     * ChannelPerformanceController constructor.
     *
     * @param BookingService $bookingService
     * @return void
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Show charts to get booking details related with seo and website
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $chartReport = $this->bookingService->getChartReport();

        $chartData = new ChannelPerformanceResource($chartReport);

        return $this->sendResponse($chartData, Response::HTTP_OK);
    }
}
