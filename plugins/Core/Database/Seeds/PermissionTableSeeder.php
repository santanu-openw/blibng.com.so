<?php namespace Zix\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Zix\Core\Events\Seeder\GetAppPermissions;
use Zix\Core\Models\Permission;
use Zix\Core\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = collect();
        $actions = collect(['view', 'create', 'update', 'delete']);

        event(new GetAppPermissions($permissions));

        $this->createPermissions($permissions, $actions);
    }

    /**
     * @param $permissions
     * @param $actions
     */
    private function createPermissions($permissions, $actions)
    {
        $role = Role::query()->where('name', 'Manager')->first();
        $permissions->map(function ($permission) use ($actions, $role) {
            $actions->map(function ($action) use ($role, $permission) {
                $per = Permission::create([
                    'name' => $action . '_' . $permission,
                    'guard_name' => 'api'
                ]);
                if ($role) {
                    $role->givePermissionTo($per->name);
                }
            });
        });
    }
}
