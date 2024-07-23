<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use App\Mail\NewLeadMessage;
use Illuminate\Support\Facades\Mail;

//CREO IL CONTROLLER CHE MI PERMETTE DI SISTEMARE/VALIDARE I DATI E SALVARLI NELL'OGGETTO CHE VERRà MESSO NEL DB
class LeadController extends Controller
{
    public function store(Request $request)
    {
        //VALIDO I DATI IN INGRESSO CHE L'UTENTE MI HA INVIATO
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        //SE LA VALIDAZIONE FALLISCE
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                //SALVO GLI ERRORI CHE MI VENGONO DATI NELLA KEY ERRORS SU CUI POTRò CICLARE
                'errors' => $validator->errors()
            ]);
        }

        //CREO L'OGGETTO LO POPOLO E LO SALVO NEL DB
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // INVIO L'EMAIL AL PROPRIETARIO DEL SITO
        Mail::to('info@boolpress.com')->send(new NewLeadMessage($new_lead));

        //SE TUTTO HA FUNZIONATO LA RISPOSTA AVRà SUCCESS TRUE
        return response()->json([
            'success' => true,
        ]);
    }
}
