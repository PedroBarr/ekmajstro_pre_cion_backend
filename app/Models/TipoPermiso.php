<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPermiso extends Model
{
    use HasFactory;

    protected $table = "tipos_permiso";

    protected $fillable = [
        "nombre",
        "descripcion",
        "diminutivo"
    ];

    //relaciones
    public function recursos ( ) {
        return $this->hasMany(Recurso::class);
    }
}