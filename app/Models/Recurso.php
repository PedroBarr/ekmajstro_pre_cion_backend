<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $table = "recursos";

    protected $fillable = [
        "nombre",
        "descripcion",
        "diminutivo",
        "enlace",
        "tipo_recurso_id",
        "tipo_permiso_id"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function tipoRecurso ( ) {
        return $this->belongsTo(TipoRecurso::class);
    }

    public function tipoPermiso ( ) {
        return $this->belongsTo(TipoPermiso::class);
    }
}