<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

use VerifyPerintis;

class VerifyPerintisMiddleware
{
    public function handle($request, Closure $next)
    {
        try
        {
            $validKey = VerifyPerintis::checkPerintisKey($request->header('perintis-key'));
            if (!$validKey)
            {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid key'
                ]);
            }
        }
        catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
        return $next($request);
    }
}