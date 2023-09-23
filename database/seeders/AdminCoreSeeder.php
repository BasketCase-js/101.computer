<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BalajiDharma\LaravelMenu\Models\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminCoreSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'menu list',
            'menu create',
            'menu edit',
            'menu delete',
            'menu.item list',
            'menu.item create',
            'menu.item edit',
            'menu.item delete',
            'category list',
            'category create',
            'category edit',
            'category delete',
            'category.type list',
            'category.type create',
            'category.type edit',
            'category.type delete',
            'computer list',
            'computer create',
            'computer edit',
            'computer delete',
            'joystick list',
            'joystick create',
            'joystick edit',
            'joystick delete',
            'keyboard list',
            'keyboard create',
            'keyboard edit',
            'keyboard delete',
            'monitor list',
            'monitor create',
            'monitor edit',
            'monitor delete',
            'mouse list',
            'mouse create',
            'mouse edit',
            'mouse delete',
            'peripheral list',
            'peripheral create',
            'peripheral edit',
            'peripherals delete',
            'cable list',
            'cable create',
            'cable edit',
            'cable delete',
            'terminal list',
            'terminal create',
            'terminal edit',
            'terminal delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('permission list');
        $role1->givePermissionTo('role list');
        $role1->givePermissionTo('user list');
        $role1->givePermissionTo('menu list');
        $role1->givePermissionTo('computer list');
        $role1->givePermissionTo('menu.item list');
        $role1->givePermissionTo('joystick list');
        $role1->givePermissionTo('keyboard list');
        $role1->givePermissionTo('monitor list');
        $role1->givePermissionTo('mouse list');
        $role1->givePermissionTo('peripheral list');
        $role1->givePermissionTo('cable list');
        $role1->givePermissionTo('terminal list');

        $role2 = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $role2->givePermissionTo($permission);
        }

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'is_admin' => '1',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'mgalea@example.com',
            'is_admin' => '1',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => '1',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);

        // create menu
        $menu = Menu::create([
            'name' => 'Admin',
            'machine_name' => 'admin',
            'description' => 'Admin Menu',
        ]);

        $menu_items = [
            [
                'name'      => 'Dashboard',
                'uri'       => '/dashboard',
                'enabled'   => 1,
                'weight'    => 0,
            ],
            [
                'name'      => 'Permissions',
                'uri'       => '/<admin>/permission',
                'enabled'   => 1,
                'weight'    => 1,
            ],
            [
                'name'      => 'Roles',
                'uri'       => '/<admin>/role',
                'enabled'   => 1,
                'weight'    => 2,
            ],
            [
                'name'      => 'Users',
                'uri'       => '/<admin>/user',
                'enabled'   => 1,
                'weight'    => 3,
            ],
            [
                'name'      => 'Menus',
                'uri'       => '/<admin>/menu',
                'enabled'   => 1,
                'weight'    => 4,
            ],
            [
                'name'      => 'Categories',
                'uri'       => '/<admin>/category/type',
                'enabled'   => 1,
                'weight'    => 4,
            ]
        ];

        $menu->menuItems()->createMany($menu_items);
    }
}