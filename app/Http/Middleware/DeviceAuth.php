<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Board;

class DeviceAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Device token required'
            ], 401);
        }

        $board = Board::where('device_token', $token)
            ->where('status', 1)
            ->first();

        if (!$board) {
            return response()->json([
                'message' => 'Invalid device token'
            ], 401);
        }

        // simpan board ke request
        $request->attributes->set('board', $board);

        return $next($request);
    }
}