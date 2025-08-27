<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Language;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //////////////////////////////////////////////////  SCELTA MULTIPLA TYPE  ///////////////////////////////////////////////////////
    public function index(Request $request)
    {
        $query = Project::with(['type']);

        $query->where('visible', true);

        if ($request->filled('name_project')) {
            $query->where('name_project', 'like', '%' . $request->name_project . '%');
        }

        if ($request->filled('type_id')) {
            $query->where('type_id', $request->type_id);
        }

        if ($request->filled('language_id')) {
            $query->whereHas('languages', function ($q) use ($request) {
                $q->where('languages.id', $request->language_id);
            });
        }

        $projectsList = $query->orderByDesc('id')->paginate(6);

        return response()->json([
            'success' => true,
            'projects' => $projectsList
        ]);
    }

    public function favorite()
    {
        $project = Project::with('type')->where([
            ['visible', true],
            ['favorite', true]
        ])->take(3)->get();

        if ($project) {
            return response()->json([
                'success' => true,
                'projects' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Not found2'
            ]);
        }
    }

    public function show($slug)
    {
        $project = Project::with('type', 'languages', 'images')->where('visible', true)->where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Not found1'
            ]);
        }
    }

    public function types()
    {
        $types = Type::select('id', 'name', 'description', 'icon')->get();

        return response()->json([
            'success' => true,
            'types' => $types
        ]);
    }

    public function languages()
    {
        $languages = Language::select('id', 'name', 'description', 'icon')->get();

        return response()->json([
            'success' => true,
            'languages' => $languages
        ]);
    }
}
