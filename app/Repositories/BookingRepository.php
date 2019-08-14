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
        $bookingCount = Booking::whereDate('date_created', Carbon::today()->sub(self::NO_OF_WEEKS, 'week'))->count();

        return $bookingCount;
    }

    /**
     * Booking count of current month
     *
     * @return mixed
     */
    public function currentMonth()
    {
        $bookingCount = Booking::WhereBetween('date_created', [
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
        $bookingCount = Booking::whereBetween('date_created', [
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
        $bookingCount = Booking::whereBetween('date_created', [
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
        $bookingCount = Booking::whereBetween('date_created', [
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
        $bookingCount = Booking::whereBetween('date_created', [
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
        $bookingCount = Booking::whereBetween('date_created', [
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
        $bookingCount = Booking::whereBetween('date_created', [
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
        $bookingCount = Booking::whereBetween('date_created', [
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
        $bookingCount = Booking::whereBetween('date_created', [
            Carbon::today()->startOfQuarter()->subYear(),
            Carbon::today()->endOfQuarter()->subYear()
        ])->count();

        return $bookingCount;
    }

    /**
     * Get seo chart details based on different affiliate site ids
     *
     * @return mixed
     */
    public function seoChart()
    {
        $result = Booking::select(
                DB::raw('COUNT(CASE WHEN afid IS NULL AND afguid IS NULL then 1 ELSE NULL END) as "organic_direct",
                        COUNT(CASE WHEN afid IN (' . env('GOOGLE_ADS_SITE_ID') . ') then 1 ELSE NULL END) as "google_ads",
                        COUNT(CASE WHEN afid IN (' . env('AFFILIATE_SITE_ID') . ') then 1 ELSE NULL END) as "affiliate",
                        COUNT(CASE WHEN afid IN (' . env('THOMAS_COOK_SITE_ID') . ') then 1 ELSE NULL END) as "Thomas Cook",
                        COUNT(CASE WHEN afid IS NOT NULL AND afguid IS NOT NULL AND afid NOT IN ('. env('GOOGLE_ADS_SITE_ID') . ',' .
                        env('AFFILIATE_SITE_ID') . ',' . env('THOMAS_COOK_SITE_ID') . ') then 1 ELSE NULl END ) as "B2B"'
                )
            )->get()->first();

        return $result;
    }

    /**
     * Get website chart details based on different affiliate sites
     *
     * @return Collection
     */
    public function websiteChart(): Collection
    {
        $result = AffiliateBooking::join('affiliate_sites', 'affiliate_site_id', '=', 'affiliate_sites.id')
            ->select(DB::raw('count(booking_id), affiliate_sites.name'))
            ->whereNotNull('booking_id')
            ->groupBy('affiliate_site_id', 'affiliate_sites.name')
            ->get();

        return $result;
    }
}
