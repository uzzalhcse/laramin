<?php

namespace App\Models\Auth;

use App\Models\Acl\Module;
use App\Models\Acl\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::ucfirst($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::kebab($value);
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_roles');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permissions');
    }
}
