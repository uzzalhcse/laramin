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
        $this->user = $user;
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
        $this->user = $user;
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->office_id = $request->office_id;
        if ($request->hasFile('avatar_file')) {
            $destinationPath = '/uploads/user/';
            $file = $request->file('avatar_file');
            $filename = time().'_'.Str::of($file->getClientOriginalName())->lower()->kebab();
            $file->move(public_path() . $destinationPath, $filename);
            $filename_path = $destinationPath . $filename;
            $this->user->avatar = $filename_path;
        }
        $this->user->save();
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
