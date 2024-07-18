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

        while (count($data) < 20) {
            $projectId = rand(1, 10);
            $languageId = rand(1, 4);

            // ASSEMBLO I DUE NUMERI E LI SALVO IN UNA VARIABILE
            $concNum = $projectId . '-' . $languageId;

            // VERIFICA SE LA COPPIA ESISTE GIà
            if (!in_array($concNum, $combNum)) {
                $data[] = [
                    'project_id' => $projectId,
                    'language_id' => $languageId,
                ];

                // SE NON ESISTE GIà AGGIUNGO IL NUMERO ALL'ARRAY DEI NUMERI COMBINATI
                $combNum[] = $concNum;
            }
        }
        DB::table('language_project')->insert($data);
    }
}
