<?php

namespace App\Http\Controllers;

use App\Http\Resources\Auth\AuthResource;
use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\TestCollection;
use App\Http\Resources\TestResource;
use App\Jobs\WelcomeEmailJob;
use App\Mail\WelcomeEmail;
use App\Models\Auth\User;
use App\Models\Share\District;
use App\Models\Share\Upazila;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class TestController extends ApiController
{
    public function test(){
//        $items = User::with('office','permissions','roles')->get()->take(10);
//        $items = District::all();
        $users = Cache::remember('user', 1800, function () {
            return User::all()->take(100);
        });
        $items = AuthResource::collection($users);
//        $items = DB::table('users')->get();
//        $items = DB::select('select * from users');
        return $this->success('Items',[
//            'items'=>TestResource::collection($items),
            'items'=>$items,
//            'items'=> new TestCollection($items)
        ]);
    }

    public function testEmail(){
        $users = User::all()->take(150);
        foreach ($users as $user){
            dispatch(new WelcomeEmailJob($user));
        }
//        Mail::to($users->first()->email)->send(new WelcomeEmail($users->first()));
        return $this->success('Mail sent to '.$users->count().' number of users');
    }
}
