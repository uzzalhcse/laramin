<?php

namespace App\Interfaces\Auth;

use App\Http\Resources\Auth\UserCollection;
use App\Interfaces\BaseEloquentInterface;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface OfficeRepositoryInterface extends BaseEloquentInterface
{
}
