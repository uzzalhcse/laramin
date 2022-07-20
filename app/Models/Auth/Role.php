<?php

namespace App\Models\Auth;

use App\Models\Acl\Module;
use App\Models\Acl\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * @var string[]
     *
     */
    protected $hidden = ['created_at','updated_at','pivot'];
    public function users(){
        return $this->belongsToMany(User::class,'user_roles');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permissions');
    }
}
