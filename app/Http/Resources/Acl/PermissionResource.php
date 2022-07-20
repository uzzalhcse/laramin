<?php

namespace App\Http\Resources\Acl;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'slug'=>$this->slug,
            'checked'=>$this->checked,
            'checked_by_user'=>$this->checked_by_user,
            'features'=>$this->features->map(function ($feature){
                return [
                    'id'=>$feature->id,
                    'name'=>$feature->name,
                    'slug'=>$feature->slug,
                    'permissions'=>$feature->permissions->map(function ($permission){
                        return [
                            'id'=>$permission->id,
                            'slug'=>$permission->slug,
                            'checked'=>$permission->checked,
                            'checked_by_user'=>$permission->checked_by_user,
                            'ability_id'=>$permission->ability_id,
                        ];
                    }),
                ];
            }),
        ];
    }
}
