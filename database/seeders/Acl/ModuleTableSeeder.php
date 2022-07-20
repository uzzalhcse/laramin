<?php

namespace Database\Seeders\Acl;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now()->toDateTimeString();
        DB::table('modules')->insert([
            [
                'id'=>'1',
                'name'=>'User & Role Management',
                'slug'=>'user_role_management',
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'2',
                'name'=>'Office Management',
                'slug'=>'office_management',
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'3',
                'name'=>'IPCP',
                'slug'=>'ipcp',
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'4',
                'name'=>'Customization',
                'slug'=>'customization',
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ]
        ]);
    }
}
