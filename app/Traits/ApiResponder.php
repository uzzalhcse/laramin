<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ApiResponder
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return JsonResponse
     */
    protected function success($message = '', $data = null, $code = 200)
    {
        return response()->json([
            'code' => $code,
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param array $errors
     * @param int $code
     * @return JsonResponse
     */
    protected function error($message = '', $errors = [], $code = 400)
    {
        return response()->json([
            'code' => $code,
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ]);
    }

}
