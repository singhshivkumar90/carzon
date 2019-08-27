<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\AffiliateBooking;
use App\Models\Booking;
use App\Traits\Reports;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookingRepository extends Repository
{
    use Reports;

    /**
     * Class constants
     */
    private const NO_OF_WEEKS = 52;

    /**
     * @var object
     */
    protected $model;

    /**
     * To initialize class object/variables
     *
     * @param Booking $model
     */
    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    /**
     * Booking count of current day of current week in last year
     *
     * @return mixed
     */
    public function thisDayOfWeekLastYear()
    {
        $bookingCount = Booking::whereDate('created_at', Carbon::today()->sub(self::NO_OF_WEEKS, 'week'))->count();

        return $bookingCount;
    }

    /**
     * Booking count of current month
     *
     * @return mixed
     */
    public function currentMonth()
    {
        $bookingCount = Booking::WhereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()
        ])->count();

        return $bookingCount;
    }

    /**
     * Booking count of last month
     *
     * @return mixed
     */
    public function lastMonth()
    {
        $bookingCount = Booking::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        return $bookingCount;
    }

    /**
     * Booking count of current month in last year
     *
     * @return mixed
     */
    public function thisMonthLastYear()
    {
        $bookingCount = Booking::whereBetween('created_at', [
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->subYear()->endOfMonth()
        ])->count();

        return $bookingCount;
    }

    /**
     * Booking count of current week
     *
     * @return mixed
     */
    public function currentWeek()
    {
        $bookingCount = Booking::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()
        ])->count();

        return $bookingCount;
    }

    /**
     * Booking count of last week
     *
     * @return mixed
     */
    public function lastWeek()
    {
        $bookingCount = Booking::whereBetween('created_at', [
            Carbon::now()->startOfWeek()->subWeek(),
            Carbon::now()->endOfWeek()->subWeek()
        ])->count();

        return $bookingCount;
    }

    /**
     * Booking count of current week in last year
     *
     * @return mixed
     */
    public function thisWeekLastYear()
    {
        $bookingCount = Booking::whereBetween('created_at', [
            Carbon::today()->sub(self::NO_OF_WEEKS, 'week')->startOfWeek(),
            Carbon::today()->sub(self::NO_OF_WEEKS, 'week')->endOfWeek()
        ])->count();

        return $bookingCount;
    }

    /**
     * Booking count of current quarter
     *
     * @return mixed
     */
    public function currentQuarter()
    {
        $bookingCount = Booking::whereBetween('created_at', [
            Carbon::today()->startOfQuarter(),
            Carbon::now()
        ])->count();

        return $bookingCount;
    }

    /**
     * Booking count of last quarter
     *
     * @return mixed
     */
    public function lastQuarter()
    {
        $bookingCount = Booking::whereBetween('created_at', [
            Carbon::today()->startOfQuarter()->subQuarter(),
            Carbon::today()->subQuarter()->endOfQuarter()
        ])->count();

        return $bookingCount;
    }

    /**
     * Booking count of current quarter in last year
     *
     * @return mixed
     */
    public function thisQuarterLastYear()
    {
        $bookingCount = Booking::whereBetween('created_at', [
            Carbon::today()->startOfQuarter()->subYear(),
            Carbon::today()->endOfQuarter()->subYear()
        ])->count();

        return $bookingCount;
    }
}
