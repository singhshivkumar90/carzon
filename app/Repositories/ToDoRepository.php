<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\ToDo;
use Carbon\Carbon;

class ToDoRepository extends Repository
{
    /**
     * Fetch pending to do count
     *
     * @return mixed
     */
    public function getPendingToDoCount()
    {
        return  ToDo::whereDate('date_created', '=', Carbon::today())
            ->where('date_completed', '=', null)
            ->count();
    }

    /**
     * Fetch average resolution time for today's todo's
     *
     * @return mixed
     */
    public function getAverageResolutionTime()
    {
        $averageTime = ToDo::SelectRaw('avg((date_completed) - (date_created))')
            ->whereDate('date_created', today())
            ->whereNotNull('date_completed')
            ->get();

        return $averageTime->first()->avg;
    }

    /**
     * Fetch average resolution time for past 30 days todo's
     *
     * @return mixed
     */
    public function getAverageResolutionTimePastThirtyDays()
    {
        $averageTime = ToDo::SelectRaw('avg((date_completed) - (date_created))')
            ->whereBetween('date_created', [Carbon::today()->subDay(30, 'day'), Carbon::now()])
            ->whereNotNull('date_completed')
            ->get();

        return $averageTime->first()->avg;
    }

    /**
     * Get Weekly completed to_do count
     *
     * @return mixed
     */
    public function getCountOfCurrentWeek()
    {
        $toDoCount =  ToDo::WhereBetween('date_created', [
            Carbon::now()->startOfWeek(),
            Carbon::now()
        ])->where('is_completed', true)
            ->where('date_completed', '<', Carbon::now())
            ->count();

        return $toDoCount;
    }
}
