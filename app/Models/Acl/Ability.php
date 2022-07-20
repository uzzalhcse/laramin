<?php

namespace App\Models\Acl;

use App\Models\Auth\AbilityFeature;
use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;
    protected $hidden = ['created_at','updated_at','pivot','ability_features'];

//    protected $appends = ['checked'];

//    public function getCheckedAttribute(){
//        $role = request()->route('role');
//        if (empty(request()->route('role'))){
//            $role = request()->route('id');
//        }
//        if (!$this->roles->where('id', $role)->isEmpty()){
//            $role = $this->roles->where('id', $role)->first();
//            if (!$role->modules->isEmpty()){
//                $role->modules->where(function ($mod){
//                    if ($mod->checked){
//                        $mod->fetures->where(function ($fet){
//                           $fet->active_abilities->where('ability_id',$this->id);
//                        });
//                    }
//                });
//            }
//            return true;
//        }
//        return false;
//    }


    public function roles(){
        return $this->belongsToMany(Role::class,'ability_features');
    }
    public function ability_features(){
        return $this->hasMany(AbilityFeature::class);
    }
//    public function features(){
//        return $this->belongsToMany(Feature::class,'ability_features')
//            ->withPivot('role_id')
//            ->withTimestamps();
//    }

}
