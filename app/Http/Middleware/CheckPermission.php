<?php

namespace App\Http\Middleware;

use App\Http\Controllers\TestController;
use App\Traits\ApiResponder;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckPermission
{
    use ApiResponder;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param null $perm
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $module = null)
    {

        $user = $request->user();
        $routeName = request()->route()->getName();
        $askingFeature = $module.'.'.$routeName;
        $askingFeature = str_replace("-","_", $askingFeature);
        $ignoreRoute = config('acl.ignore');
        if ($module && in_array($askingFeature,$user->acl->merge($ignoreRoute)->toArray())){
            Log::info($askingFeature);
            return $next($request);
        }
        Log::info('No permission for '.$askingFeature);
        return $this->error("You don't have permission !");
    }
}
