<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//USO IL MODELLO
use App\Models\Project;
use App\Models\Type;
use App\Models\Language;
//USO IL CONTROLLER DI BASE
use App\Http\Controllers\Controller;
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
            "projects" => Project::OrderByDesc('id')->paginate(6),
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
            "description" => "nullable|min:100",
            "git_URL" => "required",
            "date" => "required|date",
            "type_id" => "required|exists:types,id",
            'languages' => "required|array",
            "images" => "required|array",
            //OGNI ELEMENTO DELL'ARRAY DEVE ESSERE NELLA TABELLA LANGUAGES
            'languages.*' => "exists:languages,id",
        ]);

        //CREO L'OGGETTO
        $newProject = new Project();

        //SE IL CAMPO HA SCRITTO QUALCOSA ALLORA SALVALO
        // if ($request->has('img')) {
        //     $image_path = Storage::put('uploads', $request->img);
        //     $data['img'] = $image_path;
        // }
        if ($request->hasFile('img')) {
            $image_path = $request->file('img')->store('uploads', 'public');
            $data['img'] = $image_path;
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_path = $image->store('uploads', 'public');
                $data['images'][] = $image_path;
            }
        }

        $data['favorite'] = $request->has('favorite') ? 1 : 0;

        //POPOLO L'OGGETTO CREANDO L'ISTANZA
        $newProject->fill($data);

        $newProject['slug'] = $newProject['name_project'];
        //SALVO SUL DB
        $newProject->save();

        //L'ATTACH SI FA DOPO IL SAVE E COLLEGA LE DUE TABELLE
        if (isset($data['languages'])) {
            $newProject->languages()->attach($data['languages']);
        }

        //RITORNO LA ROTTA URL
        return redirect()->route('admin.project.show', $newProject);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::with('languages')->findOrFail($id);
        $project->img = Str::startsWith($project->img, 'https') ? $project->img : asset('storage/' . $project->img);
        //////////////////////////////////////////////////  CONTROLLARE  ///////////////////////////////////////////////////////
        $project->images = $project->images->map(function ($image) {
            return Str::startsWith($image, 'https') ? $image : asset('storage/' . $image);
        });

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
            "description" => "nullable|min:100",
            "git_URL" => "required",
            "date" => "required|date",
            "type_id" => "exists:types,id",
            'languages' => "array",
            "images" => "array",
            //OGNI ELEMENTO DELL'ARRAY DEVE ESSERE NELLA TABELLA LANGUAGES
            'languages.*' => "exists:languages,id",
        ]);

        if ($request->hasFile('img')) {
            // Salva la nuova immagine
            $image_path = $request->file('img')->store('uploads', 'public');
            $data['img'] = $image_path;
                
            // Cancella la vecchia immagine se non è un link esterno
            if ($project->img && !Str::startsWith($project->img, 'http')) {
                Storage::delete($project->img);
            }
        }

        if ($request->hasFile('images')) {
            // Cancella le vecchie immagini se necessario
            if ($project->images) {
                foreach ($project->images as $oldImage) {
                    if ($oldImage && !Str::startsWith($oldImage, 'http')) {
                        Storage::delete($oldImage);
                    }
                }
            }
        }
    
        $project->update($data);

        if (isset($data['languages'])) {
            $project->languages()->sync($data['languages']);
        }

        return redirect()->route('admin.project.show', $project->id)->with('message', 'Repo modificata con successo!');
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
    //////////////////////////////////////////////////  CONTROLLARE  ///////////////////////////////////////////////////////
    public function visibility(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->visible = !$project->visible;
        $project->save();
    
        return redirect()->route('admin.project.index')->with('message', 'Visibilità aggiornata!');
    }
    //////////////////////////////////////////////////  CONTROLLARE  ///////////////////////////////////////////////////////
    public function favorite(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->favorite = !$project->favorite;
        $project->save();

        return redirect()->route('admin.project.index')->with('message', 'Preferito aggiornato!');
    }
}
