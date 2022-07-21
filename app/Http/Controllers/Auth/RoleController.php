<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\StoreRoleRequest;
use App\Http\Resources\Acl\PermissionResource;
use App\Interfaces\Auth\RoleRepositoryInterface;
use App\Models\Acl\Module;
use App\Models\Auth\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoleController extends ApiController
{
    protected RoleRepositoryInterface $roleRepository;

    /**
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index(): JsonResponse
    {
        return $this->success('Role lists',[
            'roles'=> $this->roleRepository->getAllItems()
        ]);
    }

    public function show(Role $role, Request $request){

        $request->merge([
            'role_ids'=>[$role->id]
        ]);

        $modules = Module::with('features.permissions')->where('is_enabled',1)->get();
        return $this->success($role->name.' Module list',[
            'item'=> $role,
            'modules'=> PermissionResource::collection($modules),
        ]);
    }


    public function store(StoreRoleRequest $request): JsonResponse
    {
        $role = $this->roleRepository->store($request->validated());

        $role->permissions()->attach($request->permissions);
        return $this->success('Role Permissions Saved');
    }

    public function update(StoreRoleRequest $request, Role $role): JsonResponse
    {
        $this->roleRepository->update($request->validated(),$role);

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
        $this->roleRepository->delete($role);
        return $this->success('Role deleted');
    }

}
