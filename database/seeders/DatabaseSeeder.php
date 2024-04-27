<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Access;
use App\Models\Tracking;
use App\Models\ClinicHistory;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 roles
        Role::factory(10)->create();

        // Crear 10 usuarios con sus accesos
        User::factory(10)->create()->each(function ($user) {
            $user->accesses()->saveMany(Access::factory(1)->make());
        });

        // Crear 10 historias clínicas
        ClinicHistory::factory(10)->create();

        // Crear 10 seguimientos
        Tracking::factory(10)->create();
    }
}
