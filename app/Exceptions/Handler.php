<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param  Exception  $exception
     * @return Response|JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson() || $request->expectsJson()) {
            return $this->handleApiException($exception);
        } else {
            return parent::render($request, $exception);
        }
    }

    /**
     * Handle the api exception response.
     *
     * @param Exception $exception
     * @return JsonResponse
     */
    public function handleApiException(Exception $exception): JsonResponse
    {
        if ($exception instanceof ModelNotFoundException) {
            return $this->handleMethodNotFoundException();
        }

        return response()->json([
            'data' => [],
            'errors' => $exception->getMessage()], Response::HTTP_FORBIDDEN
        );
    }

    /**
     * Handle method not found exception
     *
     * @return JsonResponse
     */
    private function handleMethodNotFoundException(): JsonResponse
    {
        return response()->json([
            'data' => [],
            'errors' => trans('validation.resource_not_found')], Response::HTTP_NOT_FOUND
        );
    }
}
