<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::create(['name' => 'superadmin']);
        $admin      = Role::create(['name' => 'admin']);
        $editor     = Role::create(['name' => 'editor']);
        $roleuser   = Role::create(['name' => 'user']);


        $permissions = [
            [
            'group_name' => 'Dashboard',
            'permissions' => [
                //Dashboard Assign
                'dashboard.view',
                ],
            ],
            [
                'group_name' => 'Blog',
                'permissions' => [
                    // Assign Blog Permission
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',
                ],
            ],
            [
                'group_name' => 'Admin',
                'permissions' => [
                    //admin Permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ],
            ],
            [
                'group_name' => 'Role',
                'permissions' => [
                    // Role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ],
            ],
            [
                'group_name' => 'Profile',
                'permissions' => [
                    // Profile Permissions
                    'profile.view',
                    'profile.edit'
                ],
            ],
            [
                'group_name' => 'Project',
                'permissions' => [
                    // Profile Permissions
                    'project.create',
                    'project.view',
                    'project.edit',
                    'project.delete'
                ],
            ],
            [
                'group_name' => 'Visitors',
                'permissions' => [
                    // Profile Permissions
                    'visitor.create',
                    'visitor.view',
                    'visitor.edit',
                    'visitor.delete'
                ],
            ],
            [
                'group_name' => 'Categories',
                'permissions' => [
                    // Profile Permissions
                    'category.create',
                    'category.view',
                    'category.edit',
                    'category.delete'
                ],
            ],
            [
                'group_name' => 'Item Particular',
                'permissions' => [
                    // Profile Permissions
                    'item-particular.create',
                    'item-particular.view',
                    'item-particular.edit',
                    'item-particular.delete'
                ],
            ],
            [
                'group_name' => 'Client',
                'permissions' => [
                    // Profile Permissions
                    'client.create',
                    'client.view',
                    'client.edit',
                    'client.delete'
                ],
            ],
            [
                'group_name' => 'Bank',
                'permissions' => [
                    // Profile Permissions
                    'bank.create',
                    'bank.view',
                    'bank.edit',
                    'bank.delete'
                ],
            ],
            [
                'group_name' => 'Bank withdraw',
                'permissions' => [
                    // Profile Permissions
                    'withdraw.create',
                    'withdraw.view',
                    'withdraw.edit',
                    'withdraw.delete'
                ],
            ],
            [
                'group_name' => 'Bank Deposit',
                'permissions' => [
                    // Profile Permissions
                    'deposit.create',
                    'deposit.view',
                    'deposit.edit',
                    'deposit.delete'
                ],
            ],
            [
                'group_name' => 'Cash Opening',
                'permissions' => [
                    // Profile Permissions
                    'cash.create',
                    'cash.view',
                    'cash.edit',
                    'cash.delete'
                ],
            ],
            [
                'group_name' => 'Report',
                'permissions' => [
                    // Profile Permissions
                    'project-wise-client-report.view',
                    'visistor-report.view',
                    'monthly-collection-statement.view',
                    'project-balance-sheet.view',
                    'expenditure-summery-sheet.view',
                    'cash-report.view',
                    'final-balance-sheet.view',
                    'profit-loss-report.view',
                ],
            ],
       ];

        // Assign Permssions
        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $superadmin->givePermissionTo($permission);
                $permission->assignRole($superadmin);
            }
        }
    }
}
