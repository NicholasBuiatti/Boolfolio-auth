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
        //METTO IL TYPE ID PER COLLEGARLO ALLA TABELLA TYPE
        "type_id",
    ];

    //Tutti i Project avranno un metodo che restituisce il type a cui appartengono
    //USO IL SINGOLARE SE DAL PROGETTO PRENDO UN SOLO TIPO
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    //RELAZIONE MOLTI A MOLTI CON IL LINGUAGGI
    public function lenguages()
    {
        return $this->belongsToMany(Lenguage::class);
    }
}
