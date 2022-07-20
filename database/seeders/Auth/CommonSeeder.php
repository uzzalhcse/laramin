<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\Office;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '-1');
        $office_id = rand(1,2);
        $role_id = rand(1,2);
        User::factory(100)->create([
            'office_id' => $office_id
        ])->each(function ($user) use ($role_id) {
            $user->roles()->attach($role_id);
        });

    }
}
