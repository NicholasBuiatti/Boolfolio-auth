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
        $type->name = "Front-end";
        $type->description = "alloram saportis magius rembus.";
        $type->icon = "fa-solid fa-snowman";
        $type->save();

        $type = new Type();
        $type->name = "Back-end";
        $type->description = "ciao.";
        $type->icon = "fa-brands fa-font-awesome";
        $type->save();

        $type = new Type();
        $type->name = "Full-stack";
        $type->description = "salve.";
        $type->icon = "fa-solid fa-ruler-horizontal";
        $type->save();

        $type = new Type();
        $type->name = "Design";
        $type->description = "alloram saportis magius rembus.";
        $type->icon = "fa-solid fa-pen-nib";
        $type->save();
    }
}
