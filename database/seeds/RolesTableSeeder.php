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

        Permission::create([
            'name' => 'view dosen'
        ]);

        Permission::create([
            'name' => 'view alumni'
        ]);

        Permission::create([
            'name' => 'mahasiswa lihat detail',
        ]);

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'mahasiswa',
        ]);

        Role::create([
            'name' => 'alumni',
        ])->givePermissionTo('view alumni');

        Role::create([
            'name' => 'dosen',
        ])->givePermissionTo('view dosen');

        Role::create([
            'name' => 'persekutuan',
        ])->givePermissionTo('create event');

        Role::create([
           'name' => 'dpk'
        ])->givePermissionTo('create event');

        Role::create([
            'name' => 'pemuridan'
        ])->givePermissionTo('create event');

        Role::create([
            'name' => 'pkmbk'
        ])->givePermissionTo('mahasiswa lihat detail')->givePermissionTo('create event');

        Role::create([
            'name' => 'napas'
        ])->givePermissionTo('create event');

    }
}
