<?php

namespace App\Models\Acl;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Acl\Permission
 *
 * @property int $id
 * @property string $slug
 * @property int $module_id
 * @property int $feature_id
 * @property int $ability_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Acl\Ability $ability
 * @property-read \App\Models\Acl\Feature $feature
 * @property-read mixed $checked
 * @property-read mixed $checked_by_user
 * @property-read \App\Models\Acl\Module $module
 * @property-read \Illuminate\Database\Eloquent\Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereAbilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends Model
{
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];
    protected $appends = ['checked','checked_by_user'];
    public function module(){
        return $this->belongsTo(Module::class);
    }
    public function feature(){
        return $this->belongsTo(Feature::class);
    }
    public function ability(){
        return $this->belongsTo(Ability::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class,'role_permissions');
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_permissions');
    }


    public function getCheckedAttribute(){
        $role_ids = null;
        if (!empty(request()->role_ids)){
            $role_ids = request()->role_ids;
        }
       return !empty($this->roles->pluck('id')->intersect($role_ids)->all());
//       return in_array($role_id,$this->roles->pluck('id')->toArray());
    }

    public function getCheckedByUserAttribute(){
        $user_id = null;
        if (!empty(request()->user_id)){
            $user_id = request()->user_id;
        }
        return !empty($this->users->pluck('id')->intersect($user_id)->all());
//       return in_array($user_id,$this->users->pluck('id')->toArray());
    }
}
