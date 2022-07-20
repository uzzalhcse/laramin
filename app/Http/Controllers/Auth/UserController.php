<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\UserRequest;
use App\Http\Resources\Acl\PermissionResource;
use App\Http\Resources\Auth\UserResource;
use App\Interfaces\Auth\UserRepositoryInterface;
use App\Jobs\WelcomeEmailJob;
use App\Models\Acl\Module;
use App\Models\Auth\User;
use App\Repositories\Auth\RedisUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends ApiController
{

    protected UserRepositoryInterface $userRepository;

    /**
     * @param RedisUserRepository $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('User lists',[
            'item'=> $this->userRepository->getAllItems()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userRepository->store($request->validated());
        $this->userRepository->saveAcl($request->role_ids,$request->permissions);

        dispatch(new WelcomeEmailJob($user));
        return $this->success('User Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(Request $request, User $user): JsonResponse
    {
        $request->merge([
            'user_id'=>[$user->id]
        ]);

        $modules = Module::with('features.permissions')->where('is_enabled',1)->get();
        return $this->success('User Info',[
            'user'=> new UserResource($user),
            'modules'=> PermissionResource::collection($modules),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        $this->userRepository->update($request->validated(),$user);
        $this->userRepository->saveAcl($user,$request->role_ids,$request->permissions);
        return $this->success('User Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userRepository->delete($user);
        return $this->success('User deleted');
    }
}
