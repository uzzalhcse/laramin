<?php

namespace App\Repositories;

use App\Http\Resources\EloquentResource;
use App\Interfaces\BaseEloquentInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class BaseEloquentRepository implements BaseEloquentInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getActiveItems()
    {
        $items = $this->model::active()->latest();
        if (method_exists($this->model, 'search')){
            $items = $items->search();
        }
        return new EloquentResource(paginate_if_required($items));
    }

    /**
     * @return mixed
     */
    public function getAllItems(): mixed
    {
        $items = $this->model::latest();
        if (method_exists($this->model, 'search')){
            $items = $items->search();
        }
        return new EloquentResource(paginate_if_required($items));
    }

    public function getMyItems()
    {
        $items = $this->model::byOwner()->latest();
        return new EloquentResource(paginate_if_required($items));
    }


    /**
     * @return mixed
     */
    public function getById($id): mixed
    {
        return $this->model::findOrFail($id);
    }


    public function store(Request $request): ?Model
    {
        $model = $this->model->create($request->validated());

        return $model->fresh();
    }

    public function update(Request $request, Model $model): ?Model
    {
        $this->model = tap($model)->update($request->validated());
        return $this->model->fresh();
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

}
