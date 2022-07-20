<?php

namespace Database\Seeders\Auth;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $offices = array(
            array('id' => '1','name' => 'Dispatch Office','bn_name' => 'ডেমো অফিস ১','org_code'=>'DMO1','office_type'=>1,'jurisdiction'=>'Division','division_id'=>1,'district_id'=>1,'upazila_id'=>1,'union_id'=>1),
            array('id' => '2','name' => 'Head Office','bn_name' => 'ডেমো অফিস ২','org_code'=>'DMO2','office_type'=>1,'jurisdiction'=>'District','division_id'=>1,'district_id'=>1,'upazila_id'=>1,'union_id'=>1),
        );

        DB::table('offices')->insert($offices);
    }
}
