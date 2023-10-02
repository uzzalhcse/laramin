<?php

namespace App\Models\Auth;

use App\Interfaces\ApiResourceInterface;
use App\Models\Acl\Module;
use App\Models\Acl\Permission;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\Auth\RoleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\Auth\Role
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $is_deletable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static RoleFactory factory(...$parameters)
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDeletedAt($value)
 * @method static Builder|Role whereDescription($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereIsDeletable($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereSlug($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Role extends Model implements ApiResourceInterface
{
    use HasFactory;

    /**
     * @var string[]
     *
     */
    protected $hidden = ['created_at','updated_at','pivot'];
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->slug = Str::kebab($model->name);
        });
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::ucfirst($value);
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_roles');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permissions');
    }

    public function formatResponse($is_detail = false): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'slug'=>$this->slug
        ];
    }
}
