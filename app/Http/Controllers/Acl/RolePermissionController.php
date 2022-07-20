<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\RolePermissionsRequest;
use App\Http\Resources\Acl\PermissionResource;
use App\Http\Resources\Auth\RolePermissions;
use App\Models\Acl\Module;
use App\Models\Auth\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RolePermissionController extends ApiController
{
    /*
     * Fetch all Modules
     *
     * */
    public function allModules(){
        $modules = Module::with('features.permissions')->where('is_enabled',1)->get();
        return $this->success('Module list',[
            'modules'=> PermissionResource::collection($modules)
        ]);
    }
}
