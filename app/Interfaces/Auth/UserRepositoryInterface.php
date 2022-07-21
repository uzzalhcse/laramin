<?php

namespace App\Interfaces\Auth;

use App\Interfaces\BaseEloquentInterface;
use App\Models\Auth\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface extends BaseEloquentInterface
{
    /**
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function updateProfile(Request $request, User $user): User;

    public function saveAcl(User $user, array $roles, array $permissions): void;
}
