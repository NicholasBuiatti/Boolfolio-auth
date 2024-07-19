<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();

        $data = [
            "languages" => $languages
        ];

        return view("admin.languages.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //PRENDO TUTTI I DATI DAL DB E LI METTO NELL'ARRAY DATA
        $data = [
            "languages" => Language::all(),
        ];

        return view('admin.languages.create', $data);
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
        $newLanguage = new Language();

        //POPOLO L'OGGETTO CREANDO L'ISTANZA
        $newLanguage->fill($data);

        //SALVO SUL DB
        $newLanguage->save();

        //RITORNO LA ROTTA URL
        return redirect()->route('admin.language.show', $newLanguage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        $data = [
            "type" => $language
        ];

        return view("admin.languages.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        $data = [
            "language" => $language,
        ];

        return view("admin.languages.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        // VALIDAZIONE
        $data = $request->validate([
            "name" => "required|min:3|max:200",
            "description" => "required|min:5|max:255",
            "icon" => "required|min:5|max:255",
        ]);

        $language->update($data);

        return redirect()->route('admin.language.show', $language->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        $language->delete();

        return redirect()->route('admin.language.index');
    }
}
