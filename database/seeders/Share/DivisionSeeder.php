<?php

namespace Database\Seeders\Share;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now()->toDateTimeString();
        $divisions = array(
            array('id' => '1','name' => 'Chattagram','bn_name' => 'চট্টগ্রাম','created_at'=>$timestamp,'updated_at'=>$timestamp),
            array('id' => '2','name' => 'Rajshahi','bn_name' => 'রাজশাহী','created_at'=>$timestamp,'updated_at'=>$timestamp),
            array('id' => '3','name' => 'Khulna','bn_name' => 'খুলনা','created_at'=>$timestamp,'updated_at'=>$timestamp),
            array('id' => '4','name' => 'Barisal','bn_name' => 'বরিশাল','created_at'=>$timestamp,'updated_at'=>$timestamp),
            array('id' => '5','name' => 'Sylhet','bn_name' => 'সিলেট','created_at'=>$timestamp,'updated_at'=>$timestamp),
            array('id' => '6','name' => 'Dhaka','bn_name' => 'ঢাকা','created_at'=>$timestamp,'updated_at'=>$timestamp),
            array('id' => '7','name' => 'Rangpur','bn_name' => 'রংপুর','created_at'=>$timestamp,'updated_at'=>$timestamp),
            array('id' => '8','name' => 'Mymensingh','bn_name' => 'ময়মনসিংহ','created_at'=>$timestamp,'updated_at'=>$timestamp)
        );

        DB::table('divisions')->insert($divisions);
    }
}
