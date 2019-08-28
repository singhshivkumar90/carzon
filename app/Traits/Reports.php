<?php
namespace App\Traits;

use Carbon\Carbon;

trait Reports
{
    /**
     * Get count of records created today
     *
     * @return mixed
     */
    public function today()
    {
        $count = $this->model->whereDate('created_at', Carbon::today())->count();

        return $count;
    }

    /**
     * Get count of records created yesterday
     *
     * @return mixed
     */
    public function yesterday()
    {
        $count = $this->model->whereDate('created_at', Carbon::yesterday())->count();

        return $count;
    }

    /**
     * Get count of records created current day in previous week
     *
     * @return mixed
     */
    public function thisDayLastWeek()
    {
        $count = $this->model->whereDate('created_at', Carbon::today()->sub(1, 'week'))->count();

        return $count;
    }
}
