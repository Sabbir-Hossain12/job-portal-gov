<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table_rows = array(
            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'Admin Dashboard',
                ]
            ],
            [
                'group_name' => 'Admin',
                'permissions' => [
                    'View Admin',
                    'Create Admin',
                    'Edit Admin',
                    'Delete Admin',
                    'Status Admin',
                ]
            ],
            [
                'group_name' => 'Role',
                'permissions' => [
                    'View Role',
                    'Create Role',
                    'Edit Role',
                    'Delete Role',
                    'Status Role',
                    'Assign Permission',
                ]
            ],
            [
                'group_name' => 'Permission',
                'permissions' => [
                    'View Permission',
                ]
            ],

            [
                'group_name' => 'Job',
                'permissions' => [
                    'View Post',
                    'Create Post',
                    'Edit Post',
                    'Delete Post',
                    'Status Post',
                    'View Position'
                ]
            ],
            
            [
                'group_name' => 'Settings',
                'permissions' => [
                    'View Settings',
                ]
            ]
        );

        foreach ($table_rows as $i => $iValue) {
            $group_name = $iValue['group_name'];

            foreach ($iValue['permissions'] as $j => $jValue) {
                \Spatie\Permission\Models\Permission::create([
                    'name' => $iValue['permissions'][$j],
                    'group_name' => $group_name
                ]);
            }
        }
    }
}
