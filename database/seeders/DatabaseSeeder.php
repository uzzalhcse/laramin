<?php

namespace Database\Seeders;

use Database\Seeders\Acl\AbilityTableSeeder;
use Database\Seeders\Acl\FeatureTableSeeder;
use Database\Seeders\Acl\ModuleTableSeeder;
use Database\Seeders\Acl\PermissionSeeder;
use Database\Seeders\Acl\RolePermissionSeeder;
use Database\Seeders\Acl\UserPermissionSeeder;
use Database\Seeders\Auth\OfficeSeeder;
use Database\Seeders\Auth\RolesTableSeeder;
use Database\Seeders\Auth\CommonSeeder;
use Database\Seeders\Auth\UsersTableSeeder;
use Database\Seeders\Share\DistrictSeeder;
use Database\Seeders\Share\DivisionSeeder;
use Database\Seeders\Share\StatusSeeder;
use Database\Seeders\Share\UnionSeeder;
use Database\Seeders\Share\UpazilaSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(StatusSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UpazilaSeeder::class);
        $this->call(UnionSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(OfficeSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        $this->call(FeatureTableSeeder::class);
        $this->call(AbilityTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserPermissionSeeder::class);
    }
}
