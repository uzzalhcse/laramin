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

trait Status
{


    public function status(){
        return $this->belongsTo(\App\Models\Share\Status::class);
    }
    public function getStatusTitleAttribute(){
        return $this->status->title;
    }

}
