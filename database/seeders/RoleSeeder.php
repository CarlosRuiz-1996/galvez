<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // creo los roles que habran, que son admin y hospital
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Hospital']);

        /*
        #creo los permisos
        #para tener mas consistencia en los permisos les pongo el nombre de la ruta.
        */

        //admin hospital
        
        Permission::create(['name' => 'admin'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.hospitals.detalle'])->syncRoles([$role1]);// aqui asigno el rol al permiso
        // Permission::create(['name' => 'admin.hospitals.editar'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.hospitals.eliminar'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.hospitals.update'])->syncRoles([$role1]);
        // // admin.producto
        // Permission::create(['name' => 'admin.products'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.products.crear'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.products.guardar'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.products.editar'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.products.eliminar'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.products.update'])->syncRoles([$role1]);

        // // admin.pedido
        // Permission::create(['name' => 'admin.orders'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.orders.detalle'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.orders.liberar'])->syncRoles([$role1]);
        // //admin.catalogos
        // Permission::create(['name' => 'admin.catalogs'])->syncRoles([$role1]);

    }
}
