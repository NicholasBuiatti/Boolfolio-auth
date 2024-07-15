<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//IMPORTO IL MODELLO
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newProject = new Project();
        $newProject->name_project = 'Progetto 1';
        $newProject->description = 'Il progetto Laravel 1';
        $newProject->group = true;
        $newProject->date = now();
        $newProject->save();

        $newProject = new Project();
        $newProject->name_project = 'Progetto 2';
        $newProject->description = 'Il progetto Laravel 2';
        $newProject->group = false;
        $newProject->date = now();
        $newProject->save();

        $newProject = new Project();
        $newProject->name_project = 'Progetto 3';
        $newProject->description = 'Il progetto Laravel 3';
        $newProject->group = true;
        $newProject->date = now();
        $newProject->save();
    }
}
