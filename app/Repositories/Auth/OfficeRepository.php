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

    public function getAllItems(): AnonymousResourceCollection|OfficeCollection
    {

        if (isset(request()->page)){ // paginate if request has page query
            $items = Cache::remember('paginate_'.$this->model->getTable().'_'.request()->page,config('settings.cache_ttl'), function (){
                return $this->model::active()->latest()->paginate(config('settings.pagination.per_page'));
            });
            return new OfficeCollection($items);
        }
        $items = Cache::remember($this->model->getTable(),config('settings.cache_ttl'), function (){
            return $this->model::active()->latest()->take(20)->get();
        });
        return OfficeResource::collection($items);
    }


}
