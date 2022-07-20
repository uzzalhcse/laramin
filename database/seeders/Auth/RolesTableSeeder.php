<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now()->toDateTimeString();
        $roles =  [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'name' => 'Officer',
                'slug' => 'officer',
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ]
        ];

        DB::table('roles')->insert($roles);
    }
}
