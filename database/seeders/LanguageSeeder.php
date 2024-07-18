<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $language = new Language();
        $language->name = "PHP";
        $language->description = "bal bla bla";
        $language->icon = "so so so";
        $language->save();

        $language = new Language();
        $language->name = "JS";
        $language->description = "bal bla bla";
        $language->icon = "so so so";
        $language->save();

        $language = new Language();
        $language->name = "C++";
        $language->description = "bal bla bla";
        $language->icon = "so so so";
        $language->save();

        $language = new Language();
        $language->name = "Paython";
        $language->description = "bal bla bla";
        $language->icon = "so so so";
        $language->save();
    }
}
