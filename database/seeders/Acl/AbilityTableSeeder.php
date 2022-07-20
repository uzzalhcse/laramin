<?php

namespace Database\Seeders\Acl;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now()->toDateTimeString();
        DB::table('abilities')->insert([
            [
                'name'=>'View',
                'slug'=>'index',
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'name'=>'Create',
                'slug'=>'store',
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'name'=>'Edit',
                'slug'=>'update',
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'name'=>'Show',
                'slug'=>'show',
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'name'=>'Delete',
                'slug'=>'destroy',
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ],
            [
                'name'=>'Download',
                'slug'=>'download',
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp,
            ]
        ]);
    }
}
