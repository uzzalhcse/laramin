<?php

namespace Database\Seeders\Acl;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $timestamp = Carbon::now()->toDateTimeString();
        DB::table('permissions')->insert([
            // Module/Group.Feature/Model/TableName.Ability/Action

            ['id'=>1, 'slug'=>'user_role_management.users.index', 'module_id'=>'1', 'feature_id'=>'1', 'ability_id'=>'1', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>2, 'slug'=>'user_role_management.users.store', 'module_id'=>'1', 'feature_id'=>'1', 'ability_id'=>'2', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>3, 'slug'=>'user_role_management.users.update', 'module_id'=>'1', 'feature_id'=>'1', 'ability_id'=>'3', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>4, 'slug'=>'user_role_management.users.show', 'module_id'=>'1', 'feature_id'=>'1', 'ability_id'=>'4', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>5, 'slug'=>'user_role_management.users.destroy', 'module_id'=>'1', 'feature_id'=>'1', 'ability_id'=>'5', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>6, 'slug'=>'user_role_management.users.download', 'module_id'=>'1', 'feature_id'=>'1', 'ability_id'=>'6', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],


            ['id'=>7, 'slug'=>'user_role_management.roles.index', 'module_id'=>'1', 'feature_id'=>'2', 'ability_id'=>'1', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>8, 'slug'=>'user_role_management.roles.store', 'module_id'=>'1', 'feature_id'=>'2', 'ability_id'=>'2', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>9, 'slug'=>'user_role_management.roles.update', 'module_id'=>'1', 'feature_id'=>'2', 'ability_id'=>'3', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>10, 'slug'=>'user_role_management.roles.show', 'module_id'=>'1', 'feature_id'=>'2', 'ability_id'=>'4', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>11, 'slug'=>'user_role_management.roles.destroy', 'module_id'=>'1', 'feature_id'=>'2', 'ability_id'=>'5', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],


            ['id'=>12, 'slug'=>'user_role_management.permissions.index', 'module_id'=>'1', 'feature_id'=>'3', 'ability_id'=>'1', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>13, 'slug'=>'user_role_management.permissions.store', 'module_id'=>'1', 'feature_id'=>'3', 'ability_id'=>'2', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>14, 'slug'=>'user_role_management.permissions.update', 'module_id'=>'1', 'feature_id'=>'3', 'ability_id'=>'3', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>15, 'slug'=>'user_role_management.permissions.show', 'module_id'=>'1', 'feature_id'=>'3', 'ability_id'=>'4', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>16, 'slug'=>'user_role_management.permissions.destroy', 'module_id'=>'1', 'feature_id'=>'3', 'ability_id'=>'5', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],

            ['id'=>17, 'slug'=>'office_management.offices.index', 'module_id'=>'2', 'feature_id'=>'4', 'ability_id'=>'1', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>18, 'slug'=>'office_management.offices.store', 'module_id'=>'2', 'feature_id'=>'4', 'ability_id'=>'2', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>19, 'slug'=>'office_management.offices.update', 'module_id'=>'2', 'feature_id'=>'4', 'ability_id'=>'3', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>20, 'slug'=>'office_management.offices.show', 'module_id'=>'2', 'feature_id'=>'4', 'ability_id'=>'4', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>21, 'slug'=>'office_management.offices.destroy', 'module_id'=>'2', 'feature_id'=>'4', 'ability_id'=>'5', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],

            ['id'=>22, 'slug'=>'ipcp.case_types.index', 'module_id'=>'3', 'feature_id'=>'5', 'ability_id'=>'1', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>23, 'slug'=>'ipcp.case_types.update', 'module_id'=>'3', 'feature_id'=>'5', 'ability_id'=>'3', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>24, 'slug'=>'ipcp.case_types.show', 'module_id'=>'3', 'feature_id'=>'5', 'ability_id'=>'4', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],

            ['id'=>25, 'slug'=>'customization.pages.index', 'module_id'=>'4', 'feature_id'=>'6', 'ability_id'=>'1', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>26, 'slug'=>'customization.pages.store', 'module_id'=>'4', 'feature_id'=>'6', 'ability_id'=>'2', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],

            ['id'=>27, 'slug'=>'customization.faqs.index', 'module_id'=>'4', 'feature_id'=>'7', 'ability_id'=>'1', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>28, 'slug'=>'customization.faqs.store', 'module_id'=>'4', 'feature_id'=>'7', 'ability_id'=>'2', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>29, 'slug'=>'customization.faqs.update', 'module_id'=>'4', 'feature_id'=>'7', 'ability_id'=>'3', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>30, 'slug'=>'customization.faqs.show', 'module_id'=>'4', 'feature_id'=>'7', 'ability_id'=>'4', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
            ['id'=>31, 'slug'=>'customization.faqs.destroy', 'module_id'=>'4', 'feature_id'=>'7', 'ability_id'=>'5', 'created_at'=>$timestamp, 'updated_at'=>$timestamp],
        ]);
    }
}
