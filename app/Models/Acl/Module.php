<?php

namespace App\Models\Acl;

use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $with = ['features'];
    protected $hidden = ['description','is_enabled','created_at','updated_at','pivot','roles'];
    protected $appends = ['checked','checked_by_user'];

    public function getCheckedAttribute(){
        return in_array(true, $this->permissions->pluck('checked')->toArray());
    }
    public function getCheckedByUserAttribute(){
        return in_array(true, $this->permissions->pluck('checked_by_user')->toArray());
    }
//    public function getCheckedAttribute(){
////        dd(request()->route('role'));
////        dd($this->roles->pluck('id'));
////        dd(in_array(request()->route('role'),$this->roles->pluck('id')->toArray()));
//        $role = request()->route('role');
////        $roles = $this->roles->pluck('id');
////        dd($this->roles->where('id', $role)->isEmpty());
////        if ($this->roles->where('id', $role)->isEmpty()){
////            return true;
////        }
//        return false;
//    }


//    public function roles(){
//        return $this->belongsToMany(Role::class,'module_roles')->withTimestamps();
//    }
    /**
     * Get the features for the module.
     */
    public function features()
    {
        return $this->hasMany(Feature::class)->where('is_enabled',1);
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
