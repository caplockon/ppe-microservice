<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ApiKeyAuthentication
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header('X-API-KEY');
        if ($key === env('API_KEY')) {
            return $next($request);
        }

        throw new UnauthorizedHttpException("Unauthenticated", "Unauthenticated");
    }
}
