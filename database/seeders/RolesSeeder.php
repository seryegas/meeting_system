<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role_name' => 'Сотрудник']);
        Role::create(['role_name' => 'Секретарь']);
        Role::create(['role_name' => 'Председатель']);
    }
}
