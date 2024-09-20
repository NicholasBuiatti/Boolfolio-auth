<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Mario Rossi',
                'email' => 'mario.rossi@example.com',
                'message' => 'Ciao, vorrei maggiori informazioni sui vostri servizi.'
            ],
            [
                'name' => 'Luca Bianchi',
                'email' => 'luca.bianchi@example.com',
                'message' => 'Salve, ho bisogno di supporto tecnico.'
            ],
            [
                'name' => 'Giulia Verdi',
                'email' => 'giulia.verdi@example.com',
                'message' => 'Buongiorno, sono interessata a una collaborazione.'
            ],
            [
                'name' => 'Alessandro Neri',
                'email' => 'alessandro.neri@example.com',
                'message' => 'Salve, ho una domanda riguardo il prodotto X.'
            ],
            [
                'name' => 'Elena Gallo',
                'email' => 'elena.gallo@example.com',
                'message' => 'Ciao, vorrei ricevere una demo gratuita.'
            ],
        ];

        foreach ($messages as $msg) {
            $NewMessage = new Lead();
            $NewMessage->name = $msg['name'];
            $NewMessage->email = $msg['email'];
            $NewMessage->message = $msg['message'];
            $NewMessage->save();
        }
    }
}
