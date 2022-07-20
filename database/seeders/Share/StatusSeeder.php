<?php

namespace Database\Seeders\Share;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $statuses = array(
            array('id' => '1','title' => 'Active','code' => '1',),
            array('id' => '2','title' => 'Inactive','code' => '0',),
            array('id' => '3','title' => 'Pending','code' => '2',),
            array('id' => '4','title' => 'Rejected','code' => '3',),
        );

        DB::table('statuses')->insert($statuses);
    }
}
