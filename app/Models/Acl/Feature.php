<?php

namespace App\Models\Acl;

use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Acl\Feature
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $is_enabled
 * @property int $module_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Acl\Ability[] $active_abilities
 * @property-read int|null $active_abilities_count
 * @property-read mixed $abilities
 * @property-read \App\Models\Acl\Module $module
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Acl\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Feature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Feature extends Model
{
    use HasFactory;
    protected $hidden = ['module_id','description','is_enabled','created_at','updated_at'];

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
