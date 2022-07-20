<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Acl\PermissionResource;
use App\Models\Acl\Module;
use App\Models\Auth\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoleController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('Role list',[
            'roles'=> Role::latest()->get()
        ]);
    }

    public function show($id, Request $request){
        $role = Role::find($id);
        if (!isset($role)){
            return response()->error('Role not exist');
        }
        $request->merge([
            'role_ids'=>[$id]
        ]);

        $modules = Module::with('features.permissions')->where('is_enabled',1)->get();
        return $this->success($role->name.' Module list',[
            'item'=> $role,
            'modules'=> PermissionResource::collection($modules),
        ]);
    }


    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'permissions' => 'required|array'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        /**
         * create new role
         */
        $role = new Role();
        $role->name = Str::ucfirst($request->name);
        $role->slug = Str::kebab($request->name);
        $role->description = $request->description;
        $role->save();

        $role->permissions()->attach($request->permissions);
        return $this->success('Role Permissions Saved');
    }

    public function update(Request $request, $id): JsonResponse
    {

        $rules = [
            'name' => 'required',
            'permissions' => 'required|array'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        /**
         * For Module & Role many to many relationship
         * insert pivot table
         * loop in multiple array of object
         */
        $role = Role::find($id);
        if (!isset($role)){
            return response()->error('Role not exist');
        }
        $role->name = Str::ucfirst($request->name);
        $role->slug = Str::kebab($request->name);
        $role->description = $request->description;
        $role->save();

        $role->permissions()->sync($request->permissions);
        return $this->success('Role Permission Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();
        return $this->success('Role deleted');
    }

}
