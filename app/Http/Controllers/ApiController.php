<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponder;

}
