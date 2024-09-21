<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            "projects" => Project::with(['type'])->orderByDesc('id')->paginate(6)
        ]);
    }

    public function favorite()
    {
        $project = Project::with('type')->where('favorite', true)->take(5)->get();
        if ($project) {
            return response()->json([
                'success' => true,
                "projects" => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'nessun favorito'
            ]);
        }
    }

    public function show($slug)
    {
        $project = Project::with('type')->with('languages')->where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ]);
        }
    }
}
