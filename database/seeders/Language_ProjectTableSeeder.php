<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Language_ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $combNum = [];
        $projectLangCount = array_fill(1, 15, 0); // Inizializza un array per contare le lingue per ogni progetto

        // Prima fase: assegnare casualmente linguaggi a progetti
        while (count($data) < 20) {
            $projectId = rand(1, 15);
            $languageId = rand(1, 10); // Cambiato a 10 per riflettere i linguaggi disponibili

            // Assembla i due numeri e salvali in una variabile
            $concNum = $projectId . '-' . $languageId;

            // Controlla se la combinazione esiste già
            if (!in_array($concNum, $combNum)) {
                // Aggiungi il linguaggio solo se il progetto ha meno di 2 linguaggi
                if ($projectLangCount[$projectId] < 2) {
                    $data[] = [
                        'project_id' => $projectId,
                        'language_id' => $languageId,
                    ];

                    // Aggiungi la combinazione all'array delle combinazioni
                    $combNum[] = $concNum;

                    // Incrementa il conteggio delle lingue per il progetto
                    $projectLangCount[$projectId]++;
                }
            }
        }

        // Seconda fase: garantire che ogni progetto abbia almeno 2 linguaggi
        foreach ($projectLangCount as $projectId => $count) {
            while ($count < 2) {
                $languageId = rand(1, 10); // Cambiato a 10 per riflettere i linguaggi disponibili
                $concNum = $projectId . '-' . $languageId;

                if (!in_array($concNum, $combNum)) {
                    $data[] = [
                        'project_id' => $projectId,
                        'language_id' => $languageId,
                    ];

                    $combNum[] = $concNum;
                    $count++;
                }
            }
        }

        // Inserisci i dati nel database
        DB::table('language_project')->insert($data);
    }
}
