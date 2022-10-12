<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'title' => 'user_management_access',
            ],
            [
                'title' => 'permission_create',
            ],
            [
                'title' => 'permission_edit',
            ],
            [
                'title' => 'permission_show',
            ],
            [
                'title' => 'permission_delete',
            ],
            [
                'title' => 'permission_access',
            ],
            [
                'title' => 'role_create',
            ],
            [
                'title' => 'role_edit',
            ],
            [
                'title' => 'role_show',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'role_access',
            ],
            [
                'title' => 'user_create',
            ],
            [
                'title' => 'user_edit',
            ],
            [
                'title' => 'user_show',
            ],
            [
                'title' => 'user_delete',
            ],
            [
                'title' => 'user_access',
            ],
            [
                'title' => 'audit_log_show',
            ],
            [
                'title' => 'audit_log_access',
            ],
            [
                'title' => 'profile_password_edit',
            ],
            [
                'title' => 'setting_edit',
            ],
            [
                'title' => 'setting_access',
            ],
            [
                'title' => 'batch_create',
            ],
            [
                'title' => 'batch_edit',
            ],
            [
                'title' => 'batch_show',
            ],
            [
                'title' => 'batch_delete',
            ],
            [
                'title' => 'batch_access',
            ],
            [
                'title' => 'division_create',
            ],
            [
                'title' => 'division_edit',
            ],
            [
                'title' => 'division_show',
            ],
            [
                'title' => 'division_delete',
            ],
            [
                'title' => 'division_access',
            ],
            [
                'title' => 'district_create',
            ],
            [
                'title' => 'district_edit',
            ],
            [
                'title' => 'district_show',
            ],
            [
                'title' => 'district_delete',
            ],
            [
                'title' => 'district_access',
            ],
            [
                'title' => 'upazila_create',
            ],
            [
                'title' => 'upazila_edit',
            ],
            [
                'title' => 'upazila_show',
            ],
            [
                'title' => 'upazila_delete',
            ],
            [
                'title' => 'upazila_access',
            ],
            [
                'title' => 'union_create',
            ],
            [
                'title' => 'union_edit',
            ],
            [
                'title' => 'union_show',
            ],
            [
                'title' => 'union_delete',
            ],
            [
                'title' => 'union_access',
            ],
            [
                'title' => 'field_of_work_create',
            ],
            [
                'title' => 'field_of_work_edit',
            ],
            [
                'title' => 'field_of_work_show',
            ],
            [
                'title' => 'field_of_work_delete',
            ],
            [
                'title' => 'field_of_work_access',
            ],
            [
                'title' => 'designation_create',
            ],
            [
                'title' => 'designation_edit',
            ],
            [
                'title' => 'designation_show',
            ],
            [
                'title' => 'designation_delete',
            ],
            [
                'title' => 'designation_access',
            ],
            [
                'title' => 'organization_create',
            ],
            [
                'title' => 'organization_edit',
            ],
            [
                'title' => 'organization_show',
            ],
            [
                'title' => 'organization_delete',
            ],
            [
                'title' => 'organization_access',
            ],
            [
                'title' => 'school_create',
            ],
            [
                'title' => 'school_edit',
            ],
            [
                'title' => 'school_show',
            ],
            [
                'title' => 'school_delete',
            ],
            [
                'title' => 'school_access',
            ],
            [
                'title' => 'work_create',
            ],
            [
                'title' => 'work_edit',
            ],
            [
                'title' => 'work_show',
            ],
            [
                'title' => 'work_delete',
            ],
            [
                'title' => 'work_access',
            ],
            [
                'title' => 'address_create',
            ],
            [
                'title' => 'address_edit',
            ],
            [
                'title' => 'address_show',
            ],
            [
                'title' => 'address_delete',
            ],
            [
                'title' => 'address_access',
            ],
            [
                'title' => 'event_category_create',
            ],
            [
                'title' => 'event_category_edit',
            ],
            [
                'title' => 'event_category_show',
            ],
            [
                'title' => 'event_category_delete',
            ],
            [
                'title' => 'event_category_access',
            ],
            [

                'title' => 'event_create',
            ],
            [

                'title' => 'event_edit',
            ],
            [
                'title' => 'event_show',
            ],
            [
                'title' => 'event_delete',
            ],
            [
                'title' => 'event_access',
            ]
        ];

        Permission::insert($permissions);
    }
}
