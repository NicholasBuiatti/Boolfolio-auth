<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "icon",
    ];

    //Dalle Type recupera i Projects collegati
    //USO IL PLURALE SE AD UN TIPO SONO COLLEGATI PIù PROGETTI
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
