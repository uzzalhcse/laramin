<?php

namespace Database\Seeders\Acl;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now()->toDateTimeString();
        DB::table('user_permissions')->insert(
            [
                ['user_id'=>1, 'permission_id'=>14, 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
                ['user_id'=>1, 'permission_id'=>15, 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
                ['user_id'=>1, 'permission_id'=>16, 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
                ['user_id'=>1, 'permission_id'=>17, 'created_at'=>$timestamp, 'updated_at'=>$timestamp]
            ]
        );
    }
}
