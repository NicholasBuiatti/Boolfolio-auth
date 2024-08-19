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
        $language->icon = "fa-brands fa-php";
        $language->save();

        $language = new Language();
        $language->name = "JS";
        $language->description = "bal bla bla";
        $language->icon = "fa-brands fa-js";
        $language->save();

        $language = new Language();
        $language->name = "Vue.js";
        $language->description = "fa-brands fa-vuejs";
        $language->icon = "fa-brands fa-vuejs";
        $language->save();

        $language = new Language();
        $language->name = "Paython";
        $language->description = "bal bla bla";
        $language->icon = "fa-brands fa-python";
        $language->save();
    }
}
