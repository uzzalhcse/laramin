<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use JsonSerializable;

class EloquentResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        if ($this->resource instanceof AbstractPaginator || $this->resource instanceof AbstractCursorPaginator) {
            return $this->paginateResponse($request);
        }
        return $this->collection->map(function ($item){
            return $item->formatResponse();
        });
    }
    public function paginateResponse($request): array
    {
        return [
            'data' => $this->collection->map(function ($item){
                return $item->formatResponse();
            }),
            "current_page" => $this->currentPage(),
            "first_page_url" =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'=1',
            "prev_page_url" =>  $this->previousPageUrl(),
            "next_page_url" =>  $this->nextPageUrl(),
            "last_page_url" =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'='.$this->lastPage(),
            "last_page" =>  $this->lastPage(),
            "per_page" =>  $this->perPage(),
            "total" =>  $this->total(),
            "path" =>  $this->getOptions()['path'],
        ];
    }
}
