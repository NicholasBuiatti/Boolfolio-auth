<?php

//AGGIORNO IL PERCORSO
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//IMPORTO IL CONTROLLER PER POTERLO ESTENDERE
use App\Http\Controllers\Controller;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        $data = [
            "types" => $types
        ];

        return view("admin.types.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //PRENDO TUTTI I DATI DAL DB E LI METTO NELL'ARRAY DATA
        $data = [
            "types" => Type::all(),
        ];

        return view('admin.types.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        $data = $request->validate([
            "name" => "required|min:3|max:200",
            "description" => "required|min:5|max:255",
            "icon" => "required|min:5|max:255",
        ]);

        //CREO L'OGGETTO
        $newType = new Type();

        //POPOLO L'OGGETTO CREANDO L'ISTANZA
        $newType->fill($data);

        //SALVO SUL DB
        $newType->save();

        //RITORNO LA ROTTA URL
        return redirect()->route('admin.type.show', $newType);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $data = [
            "type" => $type
        ];

        return view("admin.types.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $data = [
            "type" => $type,
        ];

        return view("admin.types.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        // VALIDAZIONE
        $data = $request->validate([
            "name" => "required|min:3|max:200",
            "description" => "required|min:5|max:255",
            "icon" => "required|min:5|max:255",
        ]);

        $type->update($data);

        return redirect()->route('admin.type.show', $type->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.type.index');
    }
}
