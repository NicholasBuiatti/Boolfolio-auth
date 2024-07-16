<?php

namespace Database\Seeders;

use App\Models\Lenguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class LenguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lenguage = new Lenguage();
        $lenguage->name = "PHP";
        $lenguage->description = "bal bla bla";
        $lenguage->icon = "so so so";
        $lenguage->save();

        $lenguage = new Lenguage();
        $lenguage->name = "JS";
        $lenguage->description = "bal bla bla";
        $lenguage->icon = "so so so";
        $lenguage->save();

        $lenguage = new Lenguage();
        $lenguage->name = "C++";
        $lenguage->description = "bal bla bla";
        $lenguage->icon = "so so so";
        $lenguage->save();

        $lenguage = new Lenguage();
        $lenguage->name = "Paython";
        $lenguage->description = "bal bla bla";
        $lenguage->icon = "so so so";
        $lenguage->save();
    }
}
