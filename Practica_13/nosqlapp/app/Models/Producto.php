<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Especificar la conexión a MongoDB
    protected $connection = 'mongodb';
    
    // Nombre de la colección (opcional, por defecto sería 'productos')
    protected $collection = 'productos';
    
    // Campos asignables masivamente
    protected $fillable = [
        'nombre', 
        'descripcion', 
        'precio', 
        'stock'
    ];
}