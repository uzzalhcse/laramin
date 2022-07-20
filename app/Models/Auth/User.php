<?php

namespace App\Models\Auth;

use App\Http\Resources\Auth\RolePermissions;
use App\Models\Acl\Module;
use App\Models\Acl\Permission;
use App\Traits\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Status;

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
}
