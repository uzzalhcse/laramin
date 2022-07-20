<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email'=>$this->email,
            'office_id'=>$this->office_id,
            'role_ids'=>$this->roles->pluck('id'),
            'roles'=>$this->roles,
            'is_active'=>$this->is_active,
            'status_id'=>$this->status_id,
        ];
    }
}
