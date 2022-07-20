<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Auth\AuthResource;
use App\Models\Auth\User;
use App\Repositories\Auth\RedisUserRepository;
use App\Rules\MatchOldPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    protected RedisUserRepository $userRepository;

    public function __construct(RedisUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request): JsonResponse
    {
        $rules = [
            'email' => 'required',
            'password' => 'required|string'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        elseif (!Auth::attempt($request->only('email','password'))) {
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

    public function updateProfile(Request $request){
        $request->validate([
            'avatar_file' =>  'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'office_id' => 'required',
        ]);
        $user = $this->userRepository->updateProfile($request,Auth::user());
        return $this->success('Profile updated successfully',[
            'user'=>$user
        ]);

    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => 'required|string|min:8|different:current_password',
            'password_confirmation' => 'required|same:new_password'
        ]);
        User::find(Auth::id())->update(['password'=> $request->new_password]);
        return $this->success('Successfully Change Password');

    }


}