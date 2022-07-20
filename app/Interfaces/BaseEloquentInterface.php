<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseEloquentInterface
{
    /**
     * get paginate item if request exit query 'page'
     * get paginate item if request exit query 'page'
     * without paginate return latest n items
     */
    public function getAllItems();

    /**
     * @param array $payload
     * @return Model|null
     */
    public function store(array $payload): ?Model;

    /**
     * @param array $payload
     * @param Model $model
     * @return Model|null
     */
    public function update(array $payload, Model $model): ?Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;
}
