<?php

namespace App\Models\Acl;

use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Acl\Module
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $is_enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Acl\Feature[] $features
 * @property-read int|null $features_count
 * @property-read mixed $checked
 * @property-read mixed $checked_by_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Acl\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
