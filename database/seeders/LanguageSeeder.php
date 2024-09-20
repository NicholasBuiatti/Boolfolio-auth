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
        $languages = [
            [
                'name' => 'Python',
                'description' => 'Un linguaggio di programmazione versatile e potente, ideale per sviluppo web, data science e automazione.',
                'icon' => 'fa-brands fa-python'
            ],
            [
                'name' => 'JavaScript',
                'description' => 'Un linguaggio di scripting per il web, essenziale per lo sviluppo front-end e sempre più utilizzato anche sul back-end.',
                'icon' => 'fa-brands fa-js'
            ],
            [
                'name' => 'Java',
                'description' => 'Un linguaggio di programmazione ad oggetti, ampiamente utilizzato per applicazioni aziendali e sviluppo Android.',
                'icon' => 'fa-brands fa-java'
            ],
            [
                'name' => 'PHP',
                'description' => 'Un linguaggio di scripting lato server, molto usato per lo sviluppo di siti web e applicazioni web dinamiche.',
                'icon' => 'fa-brands fa-php'
            ],
            [
                'name' => 'Ruby',
                'description' => 'Un linguaggio di programmazione noto per la sua sintassi elegante e la popolarità del framework Ruby on Rails.',
                'icon' => 'fa-brands fa-ruby'
            ],
            [
                'name' => 'Laravel',
                'description' => 'Un framework PHP per lo sviluppo di applicazioni web, noto per la sua eleganza e facilità d\'uso.',
                'icon' => 'fa-brands fa-laravel'
            ],
            [
                'name' => 'Vue.js',
                'description' => 'Un framework JavaScript progressivo per costruire interfacce utente, facile da integrare con altre librerie.',
                'icon' => 'fa-brands fa-vuejs'
            ],
            [
                'name' => 'C#',
                'description' => 'Un linguaggio di programmazione sviluppato da Microsoft, utilizzato per applicazioni desktop, web e giochi.',
                'icon' => 'fa-brands fa-windows'
            ],
            [
                'name' => 'Go',
                'description' => 'Un linguaggio di programmazione open source, sviluppato da Google, noto per la sua efficienza e facilità di utilizzo.',
                'icon' => 'fa-brands fa-golang'
            ],
            [
                'name' => 'Kotlin',
                'description' => 'Un linguaggio di programmazione moderno e conciso, utilizzato principalmente per lo sviluppo di app Android.',
                'icon' => 'fa-brands fa-java'
            ],
        ];

        foreach ($languages as $lang) {
            $language = new Language();
            $language->name = $lang['name'];
            $language->description = $lang['description'];
            $language->icon = $lang['icon'];
            $language->save();
        }
    }
}
