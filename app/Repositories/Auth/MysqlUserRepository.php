<?php

namespace App\Repositories\Auth;

use App\Http\Resources\Auth\UserCollection;
use App\Http\Resources\Auth\UserResource;
use App\Interfaces\Auth\UserRepositoryInterface;
use App\Models\Auth\User;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class MysqlUserRepository extends BaseEloquentRepository implements UserRepositoryInterface
{
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getAllItems(): UserCollection|AnonymousResourceCollection
    {
        if (isset(request()->page)){ // paginate if request has page query
            return new UserCollection(User::with('status','roles')->latest()->paginate(config('settings.pagination.per_page')));
        }
        return UserResource::collection(User::latest()->take(20)->get());
    }

    public function updateProfile(Request $request, $user): User
    {
        $this->update($request->validated(),$user);
        if ($request->hasFile('avatar_file')) {
            $destinationPath = '/uploads/user/';
            $file = $request->file('avatar_file');
            $filename = time().'_'.Str::of($file->getClientOriginalName())->lower()->kebab();
            $file->move(public_path() . $destinationPath, $filename);
            $filename_path = $destinationPath . $filename;
            $user->avatar = $filename_path;
        }
        return $this->user;
    }

    /**
     * @param User $user
     * @param array $roles
     * @param array $permissions
     * @return void
     */
    public function saveAcl(User $user, array $roles, array $permissions): void
    {
        $user->roles()->sync($roles);
        $user->permissions()->sync($roles);
    }
}
