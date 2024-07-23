<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//CREO LA CLASSE LEAD PER POTER POI FILLARE L'OGGETTO CHE VERRà CREATO
class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message'];
}
