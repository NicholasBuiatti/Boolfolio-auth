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
        $projectLangCount = array_fill(1, 10, 0); // Inizializza un array per contare le lingue per ogni progetto

        while (count($data) < 20) {
            $projectId = rand(1, 10);
            $languageId = rand(1, 4);

            // Assembla i due numeri e salvali in una variabile
            $concNum = $projectId . '-' . $languageId;

            // Controlla se la combinazione esiste già
            if (!in_array($concNum, $combNum)) {
                // Assicurati che ogni progetto abbia almeno 2 lingue
                if ($projectLangCount[$projectId] < 2 || count($data) < 20) {
                    $data[] = [
                        'project_id' => $projectId,
                        'language_id' => $languageId,
                    ];

                    // Se non esiste già, aggiungi il numero all'array delle combinazioni
                    $combNum[] = $concNum;

                    // Incrementa il conteggio delle lingue per il progetto
                    $projectLangCount[$projectId]++;
                }
            }
        }

        // Assicurati che ogni progetto abbia almeno 2 lingue
        foreach ($projectLangCount as $projectId => $count) {
            while ($count < 2) {
                $languageId = rand(1, 4);
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

        DB::table('language_project')->insert($data);
    }
}
