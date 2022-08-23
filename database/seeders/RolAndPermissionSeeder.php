<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'inmobiliaria']);

        $role = Role::create(['name' => 'cliente']);

        $role = Role::create(['name' => 'operario']);

        $role= Role::create(['name' => 'productor']);

        $role = Role::create(['name' => 'admin']);

        $role = Role::create(['name' => 'callcenter']);

        $role = Role::create(['name' => 'siniestros']);

        $permissions = Permission::create([
            'name' => 'crear-poliza',    
            'name' => 'editar-poliza',
            ]);
    }
}
