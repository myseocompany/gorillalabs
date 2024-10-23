<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestActivity extends Model
{
    use HasFactory;

    //protected $table = 'test_matrices'; // Asegúrate de que el nombre de la tabla sea correcto

    // Agrega los campos que se pueden asignar masivamente, si es necesario
    protected $fillable = ['name'];
}
