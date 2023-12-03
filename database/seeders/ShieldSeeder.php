<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
class ShieldSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_activity","view_any_activity","create_activity","update_activity","restore_activity","restore_any_activity","replicate_activity","reorder_activity","delete_activity","delete_any_activity","force_delete_activity","force_delete_any_activity","view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","force_delete_category","force_delete_any_category","view_department","view_any_department","create_department","update_department","restore_department","restore_any_department","replicate_department","reorder_department","delete_department","delete_any_department","force_delete_department","force_delete_any_department","view_downloadable","view_any_downloadable","create_downloadable","update_downloadable","restore_downloadable","restore_any_downloadable","replicate_downloadable","reorder_downloadable","delete_downloadable","delete_any_downloadable","force_delete_downloadable","force_delete_any_downloadable","view_number","view_any_number","create_number","update_number","restore_number","restore_any_number","replicate_number","reorder_number","delete_number","delete_any_number","force_delete_number","force_delete_any_number","view_post","view_any_post","create_post","update_post","restore_post","restore_any_post","replicate_post","reorder_post","delete_post","delete_any_post","force_delete_post","force_delete_any_post","view_research","view_any_research","create_research","update_research","restore_research","restore_any_research","replicate_research","reorder_research","delete_research","delete_any_research","force_delete_research","force_delete_any_research","view_shield::role","view_any_shield::role","create_shield::role","update_shield::role","delete_shield::role","delete_any_shield::role","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","page_Backups","widget_StatsOverview","widget_ResearchChart","widget_PostChart"]},{"name":"panel_user","guard_name":"web","permissions":[]},{"name":"admin","guard_name":"web","permissions":["view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","view_department","view_any_department","create_department","update_department","restore_department","restore_any_department","replicate_department","reorder_department","delete_department","delete_any_department","view_downloadable","view_any_downloadable","create_downloadable","update_downloadable","restore_downloadable","restore_any_downloadable","replicate_downloadable","reorder_downloadable","delete_downloadable","delete_any_downloadable","view_post","view_any_post","create_post","update_post","restore_post","restore_any_post","replicate_post","reorder_post","delete_post","delete_any_post","view_research","view_any_research","create_research","update_research","restore_research","restore_any_research","replicate_research","reorder_research","delete_research","delete_any_research","widget_ResearchChart","widget_PostChart"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions,true))) {

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = Utils::getRoleModel()::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name']
                ]);

                if (! blank($rolePlusPermission['permissions'])) {

                    $permissionModels = collect();

                    collect($rolePlusPermission['permissions'])
                        ->each(function ($permission) use($permissionModels) {
                            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                                'name' => $permission,
                                'guard_name' => 'web'
                            ]));
                        });
                    $role->syncPermissions($permissionModels);

                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions,true))) {

            foreach($permissions as $permission) {

                if (Utils::getPermissionModel()::whereName($permission)->doesntExist()) {
                    Utils::getPermissionModel()::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
