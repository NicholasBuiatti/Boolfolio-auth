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
        for ($i = 0; $i < 10; $i++) {

            $newProject = new Project();
            $newProject->name_project = $faker->sentence(3);
            $newProject->description = $faker->sentence(20);
            $newProject->img = "https://picsum.photos/id/" . rand(1, 500) . "/1600/900";
            $newProject->date = now();
            $newProject->type_id = $faker->numberBetween(1, 4);
            $newProject->save();
        }
    }
}
