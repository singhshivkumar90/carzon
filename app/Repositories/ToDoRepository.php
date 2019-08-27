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
        return  ToDo::whereDate('created_at', '=', Carbon::today())
            ->where('completed_at', '=', null)
            ->count();
    }

    /**
     * Fetch average resolution time for today's todo's
     *
     * @return mixed
     */
    public function getAverageResolutionTime()
    {
        $averageTime = ToDo::SelectRaw('avg((completed_at) - (created_at))')
            ->whereDate('created_at', today())
            ->whereNotNull('completed_at')
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
        $averageTime = ToDo::SelectRaw('avg((completed_at) - (created_at))')
            ->whereBetween('created_at', [Carbon::today()->subDay(30, 'day'), Carbon::now()])
            ->whereNotNull('completed_at')
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
        $toDoCount =  ToDo::WhereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()
        ])->where('is_completed', true)
            ->where('completed_at', '<', Carbon::now())
            ->count();

        return $toDoCount;
    }
}
