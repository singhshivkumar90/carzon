<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\ToDoRepository;

class ToDoService
{
    /**
     * @var ToDoRepository $toDoRepository
     */
    public $toDoRepository;

    /**
     * ToDoService constructor.
     *
     * @param ToDoRepository $toDoRepository
     */
    public function __construct(ToDoRepository $toDoRepository)
    {
        $this->toDoRepository = $toDoRepository;
    }

    /**
     * Get to do details
     *
     * @return array
     */
    public function getToDoDetails(): array
    {
        $toDoDetails = [
            'pendingToDoCount' => $this->toDoRepository->getPendingToDoCount(),
            'averageResolutionTime' => $this->toDoRepository->getAverageResolutionTime(),
            'avgResolutionTimeLastThirtyDays' => $this->toDoRepository->getAverageResolutionTimePastThirtyDays(),
            'weeklyTargetAchieved' => $this->getWeeklyTargetAchieved()
        ];

        return $toDoDetails;
    }

    /**
     * Get Weekly target achieved
     *
     * @return float|int
     */
    private function getWeeklyTargetAchieved()
    {
        $currentWeekCount = $this->toDoRepository->getCountOfCurrentWeek();
        $targetAchieved = round(($currentWeekCount*100)/config('constants.TODO_WEEKLY_TARGET'), config('constants.FLOAT_PRECISION'));

        return $targetAchieved;
    }
}
