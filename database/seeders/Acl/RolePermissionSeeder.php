<?php

namespace Database\Seeders\Acl;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now()->toDateTimeString();
        $items = collect();
        for ($i = 1;$i<=31;$i++){
            $items->push(['role_id'=>1, 'permission_id'=>$i, 'created_at'=>$timestamp, 'updated_at'=>$timestamp]);
        }
        DB::table('role_permissions')->insert($items->toArray());
    }
}
