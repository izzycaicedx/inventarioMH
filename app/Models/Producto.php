<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si la tabla se llama 'productos')
    protected $table = 'productos';

    // Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'precio',
    ];
}

