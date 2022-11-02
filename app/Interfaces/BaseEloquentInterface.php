<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface BaseEloquentInterface
{
    /**
     * get paginate item if request query exist 'page'
     * without paginate return latest n items
     */
    public function getActiveItems();

    public function getAllItems();

    public function getMyItems();

    public function getById($id);

    /**
     * @param Request $request
     * @return Model|null
     */
    public function store($request): ?Model;

    /**
     * @param Request $request
     * @param Model $model
     * @return Model|null
     */
    public function update($request, Model $model): ?Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;
}
