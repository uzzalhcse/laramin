<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
          'office'=>$this->office,
          'avatar'=>$this->avatar,
          'roles'=>$this->roles->pluck('slug'),
          'acl'=>$this->acl,
        ];
    }
}
