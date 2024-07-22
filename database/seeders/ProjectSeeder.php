<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
            $newProject->slug = Str::slug($newProject->name_project, '-');
            $newProject->description = $faker->sentence(20);
            $newProject->img = "https://picsum.photos/id/" . rand(1, 500) . "/1600/900";
            $newProject->git_URL = "https://github.com/NicholasBuiatti/Boolfolio.git";
            $newProject->date = now();
            $newProject->favorite = false;
            $newProject->type_id = $faker->numberBetween(1, 4);
            $newProject->save();
        }
        $newProject = new Project();
        $newProject->name_project = $faker->sentence(3);
        $newProject->slug = Str::slug($newProject->name_project, '-');
        $newProject->description = $faker->sentence(20);
        $newProject->img = "https://picsum.photos/id/" . rand(1, 500) . "/1600/900";
        $newProject->git_URL = "https://github.com/NicholasBuiatti/Boolfolio.git";
        $newProject->date = now();
        $newProject->favorite = true;
        $newProject->type_id = $faker->numberBetween(1, 4);
        $newProject->save();
    }
}
