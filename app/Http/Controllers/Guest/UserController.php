<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lenguage;
use App\Models\Project;
use App\Models\Type;

class UserController extends Controller
{
    public function projects_view()
    {
        $projects = Project::all();
        return view('projects_view', compact('projects'));
    }
    public function types_view()
    {
        $types = Type::all();
        return view('types_view', compact('types'));
    }
    public function languages_view()
    {
        $languages = Lenguage::all();
        return view('languages_view', compact('languages'));
    }
}
