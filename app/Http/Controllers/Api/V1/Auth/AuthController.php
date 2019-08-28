<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
    use AuthenticatesUsers;

    /**
     * Check user credentials for login.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $this->validateLogin($request);
        } catch (ValidationException $validationException) {
            return $this->sendResponse($validationException->errors(), $validationException->status);
        }

        $isLoggedIn = $this->attemptLogin($request);

        if (false == $isLoggedIn) {
            return $this->sendResponse(
                [], Response::HTTP_UNAUTHORIZED, trans('auth.failed'));
        }

        $token = [
            'token' => Auth::User()->createToken(config('app.name'))->accessToken
        ];

        return $this->sendResponse($token,
            Response::HTTP_OK, trans('auth.logged_in'));
    }

    /**
     * Logout user
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::user()->token()->revoke();

        return $this->sendResponse([], Response::HTTP_OK, trans('auth.logged_out'));
    }
}
