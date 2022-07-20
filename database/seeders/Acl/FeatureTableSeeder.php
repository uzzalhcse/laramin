<?php

namespace Database\Seeders\Acl;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Feature/Model seeder
         * */
        $timestamp = Carbon::now()->toDateTimeString();
        DB::table('features')->insert([
            [
                'id'=>'1',
                'name'=>'Users',
                'slug'=>'users',
                'module_id'=>1,
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'2',
                'name'=>'Roles',
                'slug'=>'roles',
                'module_id'=>1,
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'3',
                'name'=>'Permissions',
                'slug'=>'permissions',
                'module_id'=>1,
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'4',
                'name'=>'Office List',
                'slug'=>'offices',
                'module_id'=>2,
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'5',
                'name'=>'Case Types',
                'slug'=>'case_types',
                'module_id'=>3,
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'6',
                'name'=>'Pages',
                'slug'=>'pages',
                'module_id'=>4,
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'id'=>'7',
                'name'=>'Faqs',
                'slug'=>'faqs',
                'module_id'=>4,
                'is_enabled'=>1,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ]
        ]);
    }
}
