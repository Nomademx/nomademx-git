<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        $rolAdministrador = Role::create(['name' => 'Administrador']);
        $rolEmpleado = Role::create(['name' => 'Empleado']);
        $rolCliente = Role::create(['name' => 'Cliente']);
        $rolInvitado = Role::create(['name' => 'Invitado']);

        Permission::create(['name' => 'users'])->syncRoles([$rolAdministrador, $rolCliente, $rolInvitado]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$rolAdministrador, $rolEmpleado]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$rolAdministrador]);

        // Permission::create(['name' => 'usuarios'])->syncRoles([$rolAdministrador, $rolEmpleado]);
        // Permission::create(['name' => 'usuarios.create'])->syncRoles([$rolAdministrador, $rolEmpleado]);
        // Permission::create(['name' => 'usuarios.edit'])->syncRoles([$rolAdministrador, $rolEmpleado]);
        // Permission::create(['name' => 'usuarios.destroy'])->syncRoles([$rolAdministrador]);

        // Permission::create(['name' => 'prestamos'])->syncRoles([$rolAdministrador, $rolEmpleado]);
        // Permission::create(['name' => 'prestamos.create'])->syncRoles([$rolAdministrador, $rolEmpleado]);
    }
}
