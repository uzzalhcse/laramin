<?php

namespace App\Repositories;

use App\Interfaces\BaseEloquentInterface;
use Illuminate\Database\Eloquent\Model;
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

    public function getAllItems()
    {
        return AnonymousResourceCollection::collection([]);
    }
    public function store(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        Cache::flush();
        return $model->fresh();
    }

    public function update(array $payload, Model $model): ?Model
    {
        $this->model = tap($model)->update($payload);
        Cache::flush();
        return $this->model->fresh();
    }

    public function delete(Model $model): bool
    {
        Cache::flush();
        return $model->delete();
    }
}
