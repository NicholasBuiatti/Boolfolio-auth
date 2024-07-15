<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//USO IL MODELLO PROJECT
use App\Models\Project;
//USO IL CONTROLLER DI BASE
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //PRENDO TUTTI I DATI DAL DB E LI METTO NELL'ARRAY DATA
        $data = [
            "projects" => Project::all()
        ];

        //PERCORSO DELLA CARTELLA IN ROUTE
        return view("admin.projects.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        $data = $request->validate([
            "name_project" => "required|min:3|max:200",
            "description" => "required|min:5|max:255",
            "group" => "boolean",
            "date" => "required|date",
        ]);

        //CREO L'OGGETTO
        $newProject = new Project();

        //POPOLO L'OGGETTO CREANDO L'ISTANZA
        $newProject->fill($data);

        //SALVO SUL DB
        $newProject->save();

        //RITORNO LA ROTTA URL
        return redirect()->route('admin.project.show', $newProject);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $data = [
            "project" => $project
        ];

        return view("admin.projects.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $data = [
            "project" => $project
        ];

        return view("admin.projects.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();

        $project->update($data);

        return redirect()->route('admin.project.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.project.index');
    }
}
