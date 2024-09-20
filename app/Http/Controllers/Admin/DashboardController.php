<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $messages = Lead::all();
        $projects = Project::where('favorite', true)->get();
        $types = Type::all();
        $languages = Language::all();

        $data = [
            'messages' => $messages,
            'projects' => $projects,
            'types' => $types,
            'languages' => $languages,
        ];

        return view('admin.dashboard', $data);
    }
}
