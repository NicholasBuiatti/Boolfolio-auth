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
//use Cloudinary\Cloudinary;  TODO INSTALLARE
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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

    public function create()
    {
        //PRENDO TUTTI I DATI DAL DB E LI METTO NELL'ARRAY DATA
        $data = [
            "types" => Type::all(),
            "languages" => Language::all(),
        ];

        return view('admin.projects.create', $data);
    }

    // public function store(Request $request)
    // {
    //     // VALIDAZIONE
    //     $data = $request->validate([
    //         "name_project" => "required|min:3|max:200",
    //         "img" => "",
    //         "description" => "nullable|min:100",
    //         "git_URL" => "required",
    //         "date" => "required|date",
    //         "type_id" => "required|exists:types,id",
    //         'languages' => "required|array",
    //         "images" => "required|array",
    //         //OGNI ELEMENTO DELL'ARRAY DEVE ESSERE NELLA TABELLA LANGUAGES
    //         'languages.*' => "exists:languages,id",
    //     ]);

    //     //CREO L'OGGETTO
    //     $newProject = new Project();

    //     //SE IL CAMPO HA SCRITTO QUALCOSA ALLORA SALVALO
    //     // if ($request->has('img')) {
    //     //     $image_path = Storage::put('uploads', $request->img);
    //     //     $data['img'] = $image_path;
    //     // }
    //     if ($request->hasFile('img')) {
    //         $image_path = $request->file('img')->store('uploads', 'public');  //'projects', 'cloudinary'
    //         $data['img'] = $image_path;
    //     }
    //     // PER LE IMMAGINI SECONDARIE
    //             foreach($request->file('secondary_images') as $image) {
    //         $path = $image->store('projects', 'cloudinary');
    //         $project->images()->create(['image_url' => $path, 'alt' => 'Descrizione']);
    //     }

    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $image) {
    //             $image_path = $image->store('uploads', 'public'); //'projects', 'cloudinary'
    //             $data['images'][] = $image_path;
    //         }
    //     }

    //     $data['favorite'] = $request->has('favorite') ? 1 : 0;

    //     //POPOLO L'OGGETTO CREANDO L'ISTANZA
    //     $newProject->fill($data);

    //     $newProject['slug'] = $newProject['name_project'];
    //     //SALVO SUL DB
    //     $newProject->save();

    //     //L'ATTACH SI FA DOPO IL SAVE E COLLEGA LE DUE TABELLE
    //     if (isset($data['languages'])) {
    //         $newProject->languages()->attach($data['languages']);
    //     }

    //     //RITORNO LA ROTTA URL
    //     return redirect()->route('admin.project.show', $newProject);
    // }

    public function store(Request $request)
    {
        // VALIDAZIONE
        $data = $request->validate([
            "name_project" => "required|min:3|max:200",
            "img" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "description" => "nullable|min:100",
            "git_URL" => "required",
            "date" => "required|date",
            "type_id" => "required|exists:types,id",
            'languages' => "required|array",
            'languages.*' => "exists:languages,id",
            "images" => "nullable|array",
            "images.*" => "image|mimes:jpeg,png,jpg,gif",
        ]);
        // dd($data);

        // GESTIONE IMMAGINE PRINCIPALE
        if ($request->hasFile('img')) {
            $publicId = $request->file('img')->store('projects', 'cloudinary');
            $publicIdNoExt = preg_replace('/\.[^.]+$/', '', $publicId);
            $data['img'] = Cloudinary::getUrl($publicIdNoExt, [
                'width' => 800,
                'height' => 600,
                'crop' => 'limit',
                'quality' => 70 // oppure 'auto'
            ]);
        }

        // GESTIONE FAVORITE
        $data['favorite'] = $request->has('favorite') ? 1 : 0;

        // GENERA SLUG
        $data['slug'] = Str::slug($data['name_project']);

        // RIMUOVI I CAMPI CHE NON SONO NEL FILLABLE
        $projectData = collect($data)->except(['languages', 'images',])->toArray();

        // CREA IL PROJECT
        $newProject = Project::create($data);

        // GESTIONE RELAZIONI MANY-TO-MANY CON I LINGUAGGI
        if ($request->has('languages')) {
            $newProject->languages()->attach($request->languages);
        }

        // GESTIONE IMMAGINI MULTIPLE (tramite relazione hasMany)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $publicId = $image->store('projects', 'cloudinary');
                $publicIdNoExt = preg_replace('/\.[^.]+$/', '', $publicId);
                $imageUrl = Cloudinary::getUrl($publicIdNoExt, [
                    'width' => 800,
                    'height' => 600,
                    'crop' => 'limit',
                    'quality' => 70 // oppure 'auto'
                ]);
                $newProject->images()->create([
                    'image_path' => $imageUrl,
                    'alt' => 'Immagine del progetto'
                ]);
            }
        }
        // dd($data); 
        return redirect()->route('admin.project.show', $newProject)->with('message', 'Progetto creato con successo!');
    }

    public function show($id)
    {
        $project = Project::with(['languages', 'images'])->findOrFail($id);

        //CON CLOUDINARY DOVREMMO ESSERE GIà OK

        // // GESTIONE IMMAGINE PRINCIPALE
        // if ($project->img) {
        //     $project->img = Str::startsWith($project->img, 'https') ? $project->img : asset('storage/' . $project->img);
        // }

        // // GESTIONE IMMAGINI MULTIPLE (dalla relazione hasMany)
        // $project->images = $project->images->map(function ($image) {
        //     $image->image_url = Str::startsWith($image->image_url, 'https') ? $image->image_url : asset('storage/' . $image->image_url);
        //     return $image;
        // });

        $data = [
            "project" => $project,
        ];

        return view("admin.projects.show", $data);
    }

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
            "img" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "description" => "nullable|min:100",
            "git_URL" => "required",
            "date" => "required|date",
            "type_id" => "exists:types,id",
            'languages' => "array",
            'languages.*' => "exists:languages,id",
            "images" => "nullable|array",
            "images.*" => "image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        if ($request->hasFile('img')) {
            // Cancella la vecchia immagine da Cloudinary
            if ($project->img && Str::startsWith($project->img, 'http')) {
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => config('filesystems.disks.cloudinary.cloud_name'),
                        'api_key' => config('filesystems.disks.cloudinary.api_key'),
                        'api_secret' => config('filesystems.disks.cloudinary.api_secret'),
                    ]
                ]);
            
                // Estrai il public_id dalla URL
                $public_id = $this->extractPublicIdFromUrl($project->img);
                if ($public_id) {
                    $cloudinary->uploadApi()->destroy($public_id);
                }
            }
        
            // Carica la nuova immagine su Cloudinary e salva la URL pubblica
            $publicId = $request->file('img')->store('projects', 'cloudinary');
            $publicIdNoExt = preg_replace('/\.[^.]+$/', '', $publicId);
            $data['img'] = Cloudinary::getUrl($publicIdNoExt);
        }

        // GESTIONE IMMAGINI MULTIPLE
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $publicId = $image->store('projects', 'cloudinary');
                $publicIdNoExt = preg_replace('/\.[^.]+$/', '', $publicId);
                $imageUrl = Cloudinary::getUrl($publicIdNoExt);
                $newProject->images()->create([
                    'image_path' => $imageUrl,
                    'alt' => 'Immagine del progetto'
                ]);
            }
        }

        $data['favorite'] = $request->has('favorite') ? 1 : 0;
        $data['slug'] = Str::slug($data['name_project']);

        // Rimuovi campi non nel fillable
        $projectData = collect($data)->except(['languages', 'images'])->toArray();

        $project->update($projectData);

        if (isset($data['languages'])) {
            $project->languages()->sync($data['languages']);
        }

        return redirect()->route('admin.project.show', $project->id)->with('message', 'Progetto modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
            // Inizializza Cloudinary
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('filesystems.disks.cloudinary.cloud_name'),
                'api_key' => config('filesystems.disks.cloudinary.api_key'),
                'api_secret' => config('filesystems.disks.cloudinary.api_secret'),
            ]
        ]);

        // CANCELLA IMMAGINE PRINCIPALE da Cloudinary
        if ($project->img && Str::startsWith($project->img, 'http')) {
            // Estrai il public_id dall'URL di Cloudinary
            $public_id = $this->extractPublicIdFromUrl($project->img);
            if ($public_id) {
                $cloudinary->uploadApi()->destroy($public_id);
            }
        } else if ($project->img) {
            // Se è storage locale
            Storage::delete($project->img);
        }

        // CANCELLA IMMAGINI MULTIPLE da Cloudinary
        foreach ($project->images as $image) {
            if (Str::startsWith($image->image_path, 'http')) {
                $public_id = $this->extractPublicIdFromUrl($image->image_path);
                if ($public_id) {
                    $cloudinary->uploadApi()->destroy($public_id);
                }
            }
        }

        $project->delete();

        return redirect()->route('admin.project.index');
    }

    public function visibility(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->visible = !$project->visible;
        $project->save();
    
        return redirect()->route('admin.project.index')->with('message', 'Visibilità aggiornata!');
    }

    public function favorite(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->favorite = !$project->favorite;
        $project->save();

        return redirect()->route('admin.project.index')->with('message', 'Preferito aggiornato!');
    }

    private function extractPublicIdFromUrl($url)
    {
        // URL esempio: https://res.cloudinary.com/your-cloud/image/upload/v123456/projects/filename.jpg
        $pattern = '/\/v\d+\/(.+)\.\w+$/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1]; // Restituisce "projects/filename"
        }
        return null;
    }

    public function deleteImage(Request $request, $projectId, $imageId)
    {
        $project = Project::findOrFail($projectId);
        $image = $project->images()->findOrFail($imageId);

        // Cancella da Cloudinary
        if (Str::startsWith($image->image_path, 'http')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => config('filesystems.disks.cloudinary.cloud_name'),
                    'api_key' => config('filesystems.disks.cloudinary.api_key'),
                    'api_secret' => config('filesystems.disks.cloudinary.api_secret'),
                ]
            ]);

            $public_id = $this->extractPublicIdFromUrl($image->image_path);
            if ($public_id) {
                $cloudinary->uploadApi()->destroy($public_id);
            }
        }

        // Cancella dal database
        $image->delete();

        return redirect()->back()->with('message', 'Immagine eliminata!');
    }
}
// AGGIUNGERE QUESTA ROTTA PER POTER CANCELLARE LE SINGOLE IMMAGINI
// <?php
// Route::delete('/admin/projects/{project}/images/{image}', [ProjectController::class, 'deleteImage'])
//     ->name('admin.project.delete-image');

// {{-- Nel tuo view admin.projects.edit o show --}}
// @foreach($project->images as $image)
//     <div class="image-container">
//         <img src="{{ $image->image_url }}" alt="{{ $image->alt }}">
//         <form action="{{ route('admin.project.delete-image', [$project->id, $image->id]) }}" method="POST" class="d-inline">
//             @csrf
//             @method('DELETE')
//             <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro?')">
//                 Elimina
//             </button>
//         </form>
//     </div>
// @endforeach