<?php

namespace App\Repositories\Auth;

use App\Http\Resources\Auth\UserCollection;
use App\Http\Resources\Auth\UserResource;
use App\Interfaces\Auth\UserRepositoryInterface;
use App\Models\Auth\User;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RedisUserRepository extends BaseEloquentRepository implements UserRepositoryInterface
{

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
            $items = Cache::remember('paginate_'.$this->model->getTable().'_'.request()->page,config('settings.cache_ttl'), function (){
                return $this->model::latest()->paginate(config('settings.pagination.per_page'));
            });
            return new UserCollection($items);
        }
        $items = Cache::remember($this->model->getTable(),config('settings.cache_ttl'), function (){
            return $this->model::latest()->take(20)->get();
        });
        return UserResource::collection($items);
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
        Cache::flush();
        $user->save();
        return $user;
    }

    /**
     * @param array $roles
     * @param array $permissions
     * @return void
     */
    public function saveAcl($user, array $roles, array $permissions): void
    {
        $user->roles()->sync($roles);
        $user->permissions()->sync($roles);
    }
}
