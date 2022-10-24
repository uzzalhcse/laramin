<?php

namespace App\Models\Auth;

use App\Http\Resources\Auth\RolePermissions;
use App\Interfaces\ApiResourceInterface;
use App\Models\Acl\Module;
use App\Models\Acl\Permission;
use App\Traits\ScopeActive;
use App\Traits\Status;
use App\Traits\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\Auth\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $office_id
 * @property int $status_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $acl
 * @property-read mixed $is_active
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Auth\Office $office
 * @property-read \Illuminate\Database\Eloquent\Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auth\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\Share\Status $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\Auth\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements ApiResourceInterface
{
    use HasApiTokens, HasFactory, Notifiable, Status, ScopeActive, Utils;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    protected $appends = [
//        'acl',
//        'is_active'
//    ];


    /**
     * attributes
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }

    public function getIsActiveAttribute(){
        if ($this->status->code == 1){
            return true;
        }
        return false;
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'user_permissions');
    }

    public function getAclAttribute(){
        return $this->roles->map->permissions->flatten()->merge($this->permissions)->pluck('slug');
    }

    public function office(){
        return $this->belongsTo(Office::class);
    }

    public function getAvatarAttribute(){
        return url('/').$this->attributes['avatar'];
    }

    public function formatResponse($is_details = false): array{
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
