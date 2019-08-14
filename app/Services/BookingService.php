<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\BookingRepository;
use Illuminate\Http\Request;

class BookingService
{
    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    /**
     * BookingService constructor.
     *
     * @param BookingRepository $bookingRepository
     * @return void
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Get booking count details based on criteria
     *
     * @param Request $request
     * @return array
     */
    public function getCount(Request $request): array
    {
        switch ($request->with)
        {
            case 'month':
                $count = $this->bookingByMonth();
                break;

            case 'quarter':
                $count = $this->bookingByQuarter();
                break;

            case 'week':
                $count = $this->bookingByWeek();
                break;

            default:
                $count = $this->bookingByDay();
        }

        return $count;
    }

    /**
     * Get Monthly booking target achieved.
     *
     * @return float|int
     */
    public function getMonthlyTargetAchieved()
    {
        $currentMonthCount = $this->bookingRepository->currentMonth();
        $targetAchieved = round(($currentMonthCount*100)/config('constants.BOOKING_MONTHLY_TARGET'), config('constants.FLOAT_PRECISION'));

        return $targetAchieved;
    }

    /**
     * Daily booking count
     *
     * @return array
     */
    private function bookingByDay(): array
    {
        return [
            'firstSet' => [
                'key' => trans('reports.today'),
                'value' => $this->bookingRepository->today()
            ],
            'secondSet' => [
                'key' => trans('reports.yesterday'),
                'value' => $this->bookingRepository->yesterday()
            ],
            'thirdSet' => [
                'key' => trans('reports.this_day_last_week'),
                'value' => $this->bookingRepository->thisDayLastWeek()
            ],
            'fourthSet' => [
                'key' => trans('reports.this_day_of_week_last_year'),
                'value' => $this->bookingRepository->thisDayOfWeekLastYear()
            ]
        ];
    }

    /**
     * Monthly booking count
     *
     * @return array
     */
    private function bookingByMonth(): array
    {
        return [
            'firstSet' => [
                'key' => trans('reports.current_month'),
                'value' => $this->bookingRepository->currentMonth(),
            ],
            'secondSet' => [
                'key' => trans('reports.last_month'),
                'value' => $this->bookingRepository->lastMonth(),
            ],
            'thirdSet' => [
                'key' => trans('reports.this_month_last_year'),
                'value' => $this->bookingRepository->thisMonthLastYear(),
            ],
            'fourthSet' => [
                'key' => trans('reports.target_achieved'),
                'value' => $this->getMonthlyTargetAchieved(),
            ]
        ];
    }

    /**
     * Quarterly booking count
     *
     * @return array
     */
    private function bookingByQuarter(): array
    {
        $currentQuarterCount = $this->bookingRepository->currentQuarter();
        $targetAchieved = round(($currentQuarterCount*100)/config('constants.BOOKING_QUARTERLY_TARGET'), config('constants.FLOAT_PRECISION'));

        return [
            'firstSet' => [
                'key' => trans('reports.current_quarter'),
                'value' => $currentQuarterCount
            ],
            'secondSet' => [
                'key' => trans('reports.last_quarter'),
                'value' => $this->bookingRepository->lastQuarter()
            ],
            'thirdSet' => [
                'key' => trans('reports.this_quarter_last_year'),
                'value' => $this->bookingRepository->thisQuarterLastYear()
            ],
            'fourthSet' => [
                'key' => trans('reports.target_achieved'),
                'value' => $targetAchieved,
            ]
        ];
    }

    /**
     * Weekly booking count
     *
     * @return array
     */
    private function bookingByWeek(): array
    {
        $currentWeekCount = $this->bookingRepository->currentWeek();
        $targetAchieved = round(($currentWeekCount*100)/config('constants.BOOKING_WEEKLY_TARGET'), config('constants.FLOAT_PRECISION'));

        return [
            'firstSet' => [
                'key' => trans('reports.current_week'),
                'value' => $currentWeekCount,
            ],
            'secondSet' => [
                'key' => trans('reports.last_week'),
                'value' => $this->bookingRepository->lastWeek(),
            ],
            'thirdSet' => [
                'key' => trans('reports.this_week_last_year'),
                'value' => $this->bookingRepository->thisWeekLastYear(),
            ],
            'fourthSet' => [
                'key' => trans('reports.target_achieved'),
                'value' => $targetAchieved,
            ]
        ];
    }
}
