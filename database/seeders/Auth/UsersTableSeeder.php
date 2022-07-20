<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'avatar' => '/uploads/user/man.png',
                'password' => bcrypt('password'),
                'office_id' => 1,
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Officer',
                'email' => 'officer@gmail.com',
                'avatar' => '/uploads/user/man.png',
                'password' => bcrypt('password'),
                'office_id' => 2,
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Officer 2',
                'email' => 'officer2@gmail.com',
                'avatar' => '/uploads/user/man.png',
                'password' => bcrypt('password'),
                'office_id' => 2,
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Officer 3',
                'email' => 'officer3@gmail.com',
                'avatar' => '/uploads/user/man.png',
                'password' => bcrypt('password'),
                'office_id' => 2,
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]
        ];

        DB::table('users')->insert($users);
        $userRoles =  [
            [
                'user_id' => '1',
                'role_id' => '1',
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id' => '2',
                'role_id' => '2',
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id' => '3',
                'role_id' => '2',
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id' => '4',
                'role_id' => '2',
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ],
        ];

        DB::table('user_roles')->insert($userRoles);

    }
}
