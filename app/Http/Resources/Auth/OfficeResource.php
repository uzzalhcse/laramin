<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'office_type'=>$this->office_type,
            'jurisdiction'=>$this->jurisdiction,
            'division_id'=>$this->division_id,
            'district_id'=>$this->district_id,
            'upazila_id'=>$this->upazila_id,
            'union_id'=>$this->union_id,
            'division_name'=>$this->division->name,
            'district_name'=>$this->district ? $this->district->name: 'N/A',
            'upazila_name'=>$this->upazila ? $this->upazila->name: 'N/A',
            'status_name'=>$this->status->title,
            'status_id'=>$this->status_id,
        ];
    }
}
