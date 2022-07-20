<?php

namespace App\Models\Acl;

use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
//    protected $with = ['abilities'];
    protected $hidden = ['module_id','description','is_enabled','created_at','updated_at'];
//    protected $appends = ['abilities'];

    /**
     * Get the module that owns the feature.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function getAbilitiesAttribute(){

        return Ability::all();
    }
    public function permissions(){
        return $this->hasMany(Permission::class);
    }
    public function active_abilities(){
        $role = null;
        if (!empty(request()->route('role'))){
            $role = request()->route('role');
        }
        if (!empty(request()->route('role_id'))){
            $role = request()->route('role_id');

        } elseif(isset(auth()->user()->role_id)){
            $role = auth()->user()->role_id;
        }
        return $this->belongsToMany(Ability::class,'ability_features')
            ->withPivot('id', 'role_id')
            ->whereNotNull('role_id')
            ->wherePivot('role_id',$role);
    }
    public function roles(){
//        $rel = $this->belongsToMany(Role::class,'ability_features');
        return $this->belongsToMany(Role::class,'ability_features');
    }
}
