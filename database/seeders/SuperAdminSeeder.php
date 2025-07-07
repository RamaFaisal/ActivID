<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $role = Role::firstOrCreate(['name' => 'superadmin']);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => Hash::make('super123'),
        ]);

        $user->syncRoles($role);
    }
}