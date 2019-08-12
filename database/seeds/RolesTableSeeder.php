<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app() [\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create([
            'name' => 'create event'
        ]);

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'persekutuan',
        ])->givePermissionTo('create event');


    }
}
