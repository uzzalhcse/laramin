<?php

namespace App\Repositories\Auth;

use App\Http\Resources\Auth\OfficeCollection;
use App\Http\Resources\Auth\OfficeResource;
use App\Interfaces\Auth\OfficeRepositoryInterface;
use App\Models\Auth\Office;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class OfficeRepository extends BaseEloquentRepository implements OfficeRepositoryInterface
{
    protected $office;

    /**
     * @param Office $office
     */
    public function __construct(Office $office)
    {
        parent::__construct($office);
    }

}
