<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (in_array(Role::EMPLOYEE, $request->user()->role->pluck(['name'])->toArray())) {
            return response()->json(['error' => 'You are not authorized to access this page.'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
