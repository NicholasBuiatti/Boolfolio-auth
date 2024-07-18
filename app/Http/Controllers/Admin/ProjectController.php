<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//USO IL MODELLO PROJECT
use App\Models\Project;
use App\Models\Type;
//USO IL CONTROLLER DI BASE
use App\Http\Controllers\Controller;
use App\Models\Language;
//COMPONENTI PER L'IMPORTAZIONE E VERIFICA IMMAGINI
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //PRENDO TUTTI I DATI DAL DB E LI METTO NELL'ARRAY DATA
        $data = [
            "projects" => Project::all(),
        ];

        //PERCORSO DELLA CARTELLA IN ROUTE
        return view("admin.projects.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //PRENDO TUTTI I DATI DAL DB E LI METTO NELL'ARRAY DATA
        $data = [
            "types" => Type::all(),
            "languages" => Language::all(),
        ];

        return view('admin.projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        $data = $request->validate([
            "name_project" => "required|min:3|max:200",
            "img" => "",
            "description" => "required|min:5|max:255",
            "group" => "boolean",
            "date" => "required",
            "type_id" => "required",
            'languages' => 'array',
            'languages.*' => 'exists:languages,id',
        ]);

        //CREO L'OGGETTO
        $newProject = new Project();

        if ($request->has('img')) {
            $image_path = Storage::put('uploads', $request->img);
            $data['img'] = $image_path;
        }

        //POPOLO L'OGGETTO CREANDO L'ISTANZA
        $newProject->fill($data);

        //SALVO SUL DB
        $newProject->save();

        //L'ATTACH SI FA DOPO IL SAVE
        if (isset($data['languages'])) {
            $newProject->languages()->attach($data['languages']);
        }

        //RITORNO LA ROTTA URL
        return redirect()->route('admin.project.show', $newProject);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $data = [
            "project" => $project,
        ];

        return view("admin.projects.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $data = [
            "project" => $project,
            "types" => Type::all(),
            "languages" => Language::all(),
            "relations" => $project->languages->pluck('id')->toArray()
        ];

        return view("admin.projects.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // VALIDAZIONE
        $data = $request->validate([
            "name_project" => "required|min:3|max:200",
            "img" => "",
            "description" => "required|min:5|max:255",
            "group" => "boolean",
            "date" => "required",
            "type_id" => "required",
            'languages' => 'array',
            'languages.*' => 'exists:languages,id',
        ]);

        $project->update($data);

        if (isset($data['languages'])) {
            $project->languages()->sync($data['languages']);
        }

        return redirect()->route('admin.project.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->img && !Str::startsWith($project->img, 'http')) {
            // not null and not startingn with http
            Storage::delete($project->img);
        }

        $project->delete();

        return redirect()->route('admin.project.index');
    }
}
