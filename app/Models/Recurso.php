<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $table = "recursos";
    protected $primaryKey = 'rec_id';

    protected $fillable = [
        "rec_nombre",
        "rec_descripcion",
        "rec_diminutivo",
        "tp_rec_id",
        "espc_id",
        "tp_perm_id",
        "arch_id"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function tipos ( ) {
        return $this->belongsTo(TipoRecurso::class);
    }

    public function especificaciones ( ) {
        return $this->belongsTo(EspecificacionRecurso::class);
    }

    public function permisos ( ) {
        return $this->belongsTo(TipoPermiso::class);
    }

    public function archivos ( ) {
        return $this->belongsTo(Archivo::class);
    }

    public function publicaciones ( ) {
        return $this->belongsToMany(Publicacion::class);
    }

    public function previsualizaciones ( ) {
        return $this->hasMany(Previsualizacion::class);
    }
}