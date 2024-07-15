<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = new Type();
        $type->Name = "Front-end";
        $type->Description = "alloram saportis magius rembus.";
        $type->Icon = "fa-solid fa-snowman";
        $type->save();

        $type = new Type();
        $type->Name = "Back-end";
        $type->Description = "alloram saportis magius rembus.";
        $type->Icon = "fa-brands fa-font-awesome";
        $type->save();

        $type = new Type();
        $type->Name = "Full-stack";
        $type->Description = "alloram saportis magius rembus.";
        $type->Icon = "fa-solid fa-ruler-horizontal";
        $type->save();

        $type = new Type();
        $type->Name = "Design";
        $type->Description = "alloram saportis magius rembus.";
        $type->Icon = "fa-solid fa-pen-nib";
        $type->save();
    }
}
