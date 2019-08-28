<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @param string|array|object $responseData
     * @param int $responseCode
     * @param string $message
     * @param array $headers
     * @return JsonResponse
     */
    public function sendResponse($responseData, int $responseCode, $message = '', array $headers = []) : JsonResponse
    {
        return response()->json(
            ['data' => $responseData, 'message' => $message],
            $responseCode,
            $headers
        );
    }
}
