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
        $projects = [
            [
                'name_project' => 'Sito di e-commerce',
                'description' => 'Una piattaforma di e-commerce completa con gestione del catalogo, carrello e pagamenti online.',
            ],
            [
                'name_project' => 'Blog personale',
                'description' => 'Un blog per condividere pensieri, articoli e storie personali su vari argomenti.',
            ],
            [
                'name_project' => 'App di ricette',
                'description' => 'Un’app per trovare e condividere ricette, con funzionalità di ricerca avanzata e lista della spesa.',
            ],
            [
                'name_project' => 'Portfolio online',
                'description' => 'Un portfolio per presentare lavori e progetti personali in modo professionale.',
            ],
            [
                'name_project' => 'Piattaforma di corsi online',
                'description' => 'Un sito per l\'offerta di corsi online, con video, quiz e certificazioni.',
            ],
            [
                'name_project' => 'Sistema di gestione delle attività',
                'description' => 'Un’app per organizzare e gestire le attività quotidiane e i progetti.',
            ],
            [
                'name_project' => 'App di meditazione',
                'description' => 'Un’app che offre meditazioni guidate e tecniche di rilassamento per migliorare il benessere.',
            ],
            [
                'name_project' => 'Piattaforma di networking professionale',
                'description' => 'Un sito per connettere professionisti, facilitare opportunità lavorative e networking.',
            ],
            [
                'name_project' => 'Sito di viaggi',
                'description' => 'Un portale per scoprire destinazioni, pianificare viaggi e condividere esperienze.',
            ],
            [
                'name_project' => 'App per fitness',
                'description' => 'Un’app per seguire programmi di allenamento e monitorare i progressi fisici.',
            ],
            [
                'name_project' => 'Strumento di gestione delle finanze',
                'description' => 'Un’app per tenere traccia delle spese, del budget e degli investimenti.',
            ],
            [
                'name_project' => 'Servizio di streaming musicale',
                'description' => 'Una piattaforma per ascoltare e scoprire nuova musica, con playlist personalizzate.',
            ],
            [
                'name_project' => 'App per la gestione del tempo',
                'description' => 'Un’app che aiuta a pianificare e gestire il tempo in modo più efficiente.',
            ],
            [
                'name_project' => 'Marketplace per artigiani',
                'description' => 'Un sito per mettere in contatto artigiani e clienti, facilitando la vendita di prodotti fatti a mano.',
            ],
            [
                'name_project' => 'App per il monitoraggio della salute',
                'description' => 'Un’app che permette di monitorare parametri di salute e benessere personale.',
            ],
            [
                'name_project' => 'Rete sociale per lettori',
                'description' => 'Una piattaforma per lettori appassionati, per condividere libri e recensioni.',
            ],
        ];

        foreach ($projects as $projectData) {
            $newProject = new Project();
            $newProject->name_project = $projectData['name_project'];
            $newProject->slug = Str::slug($newProject->name_project, '-');
            $newProject->description = $projectData['description'];
            $newProject->img = "https://picsum.photos/id/" . rand(1, 500) . "/1600/900";
            $newProject->git_URL = "https://github.com/NicholasBuiatti/Boolfolio.git";
            $newProject->date = now();
            $newProject->favorite = rand(0, 1); // Assegna casualmente 0 o 1
            $newProject->type_id = rand(1, 4); // Assicurati che i tuoi tipi siano impostati correttamente
            $newProject->save();
        }
    }
}
