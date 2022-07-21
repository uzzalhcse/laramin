<?php

namespace App\Repositories\Auth;

use App\Http\Resources\Auth\OfficeCollection;
use App\Http\Resources\Auth\OfficeResource;
use App\Http\Resources\Auth\RoleCollection;
use App\Http\Resources\Auth\RoleResource;
use App\Interfaces\Auth\RoleRepositoryInterface;
use App\Models\Auth\Office;
use App\Models\Auth\Role;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class RoleRepository extends BaseEloquentRepository implements RoleRepositoryInterface
{
    protected $model;

    /**
     * @param Role $role
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function getAllItems(): RoleCollection | AnonymousResourceCollection
    {

        if (isset(request()->page)){ // paginate if request has page query
            $items = Cache::remember('paginate_'.$this->model->getTable().'_'.request()->page,config('settings.cache_ttl'), function (){
                return $this->model::latest()->paginate(config('settings.pagination.per_page'));
            });
            return new RoleCollection($items);
        }
        $items = Cache::remember($this->model->getTable(),config('settings.cache_ttl'), function (){
            return $this->model::latest()->take(20)->get();
        });
        return RoleResource::collection($items);
    }


}
