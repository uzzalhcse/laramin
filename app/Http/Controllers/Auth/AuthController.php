<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use App\Rules\MatchOldPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return $this->error('Credentials not match', 401);
        }
        if (!Auth::user()->is_active){
            return $this->error('Account is not Active!');
        }
        $tokenName = 'adminAuthToken';
        return $this->success('Login Success', [
            'access_token' => auth()->user()->createToken($tokenName)->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }


    public function logout(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->success('Logout Successfully');
    }

    public function info(Request $request)
    {
        return $this->success('Auth User Info',[
            'user'=>new AuthResource(Auth::user())
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request){
        $user = $this->userRepository->updateProfile($request,Auth::user());
        return $this->success('Profile updated successfully',[
            'user'=>$user
        ]);

    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        User::find(Auth::id())->update(['password'=> $request->new_password]);
        return $this->success('Successfully Change Password');

    }


}
