<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ForgotPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Send password reset link.
     *
     * @param Request $request
     * @param $response
     * @return JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response): JsonResponse
    {
        return $this->sendResponse(['message'=> trans($response)], Response::HTTP_OK);
    }

    /**
     * Send reset link failed response.
     *
     * @param Request $request
     * @param $response
     * @return JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response): JsonResponse
    {
        return $this->sendResponse(['error'=> trans($response)], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
