<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    //PER POTER USARE IL METODO FILL
    protected $fillable = [
        "name_project",
        "description",
        "group",
        "date",
    ];
}
