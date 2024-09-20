<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Lead::all();

        $data = [
            "messages" => $messages
        ];

        return view("mail.index", $data);
    }

    public function show(Lead $message)
    {
        $data = [
            "message" => $message
        ];

        return view("mail.show", $data);
    }


    public function destroy()
    {

        return redirect()->route('');
    }
}
