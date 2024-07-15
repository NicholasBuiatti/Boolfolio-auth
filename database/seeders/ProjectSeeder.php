<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//IMPORTO IL MODELLO
use App\Models\Project;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $newProject = new Project();
        $newProject->name_project = 'Progetto 1';
        $newProject->description = 'Il progetto Laravel 1';
        $newProject->group = true;
        $newProject->date = now();
        $newProject->type_id = $faker->numberBetween(1, 4);
        $newProject->save();

        $newProject = new Project();
        $newProject->name_project = 'Progetto 2';
        $newProject->description = 'Il progetto Laravel 2';
        $newProject->group = false;
        $newProject->date = now();
        $newProject->type_id = $faker->numberBetween(1, 4);
        $newProject->save();

        $newProject = new Project();
        $newProject->name_project = 'Progetto 3';
        $newProject->description = 'Il progetto Laravel 3';
        $newProject->group = true;
        $newProject->date = now();
        $newProject->type_id = $faker->numberBetween(1, 4);
        $newProject->save();
    }
}
