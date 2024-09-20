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
        $types = [
            [
                'name' => 'Front-end',
                'description' => 'Sviluppo dell\'interfaccia utente e della parte visibile delle applicazioni web.',
                'icon' => 'fa-solid fa-snowman'
            ],
            [
                'name' => 'Backend',
                'description' => 'Gestione della logica server, database e API per le applicazioni web.',
                'icon' => 'fa-solid fa-server'
            ],
            [
                'name' => 'Fullstack',
                'description' => 'Competenze sia nel front-end che nel back-end, per sviluppare applicazioni complete.',
                'icon' => 'fa-solid fa-code-branch'
            ],
            [
                'name' => 'Design',
                'description' => 'Creazione di layout visivi e esperienze utente per applicazioni e siti web.',
                'icon' => 'fa-solid fa-paint-brush'
            ],
            [
                'name' => 'DevOps',
                'description' => 'Pratiche che uniscono sviluppo e operazioni per migliorare l\'efficienza del ciclo di vita del software.',
                'icon' => 'fa-solid fa-cogs'
            ],
            [
                'name' => 'Mobile Development',
                'description' => 'Sviluppo di applicazioni per dispositivi mobili su piattaforme iOS e Android.',
                'icon' => 'fa-solid fa-mobile-alt'
            ],
            [
                'name' => 'Data Science',
                'description' => 'Analisi e interpretazione dei dati per estrarre informazioni utili e supportare decisioni aziendali.',
                'icon' => 'fa-solid fa-database'
            ],
            [
                'name' => 'Cloud Computing',
                'description' => 'Utilizzo di servizi di cloud per l\'archiviazione e l\'elaborazione dei dati.',
                'icon' => 'fa-solid fa-cloud'
            ],
            [
                'name' => 'Machine Learning',
                'description' => 'Sviluppo di algoritmi per l\'apprendimento automatico e l\'intelligenza artificiale.',
                'icon' => 'fa-solid fa-brain'
            ],
            [
                'name' => 'Cybersecurity',
                'description' => 'Protezione delle informazioni e dei sistemi informatici da attacchi e vulnerabilità.',
                'icon' => 'fa-solid fa-shield-alt'
            ],
        ];

        foreach ($types as $typeData) {
            $type = new Type();
            $type->name = $typeData['name'];
            $type->description = $typeData['description'];
            $type->icon = $typeData['icon'];
            $type->save();
        }
    }
}
