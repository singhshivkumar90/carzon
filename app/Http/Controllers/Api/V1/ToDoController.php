<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Services\ToDoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ToDoController extends BaseController
{
    /**
     * @var ToDoService $toDoService
     */
    private $toDoService;

    /**
     * ToDoController constructor.
     * @param ToDoService $toDoService
     */
    public function __construct(ToDoService $toDoService)
    {
        $this->toDoService= $toDoService;
    }

    /**
     * Get to_dos related details
     *
     * @return JsonResponse
     */
    public function details(): JsonResponse
    {
        $toDoDetails = $this->toDoService->getToDoDetails();

        return $this->sendResponse($toDoDetails, Response::HTTP_OK);
    }
}
