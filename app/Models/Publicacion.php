<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = "publicaciones";
    protected $primaryKey = 'pblc_id';

    protected $fillable = [
        "pblc_titulo",
        "pblc_img_portada_uri",
        "pblc_fecha_publicacion"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function recursos ( ) {
        return $this->belongsToMany(Recurso::class);
    }

    public function etiquetas ( ) {
        return $this->belongsToMany(Etiqueta::class);
    }

    public function previsualizaciones ( ) {
        return $this->hasMany(Previsualizacion::class);
    }

    public function secciones ( ) {
        return $this->hasMany(Seccion::class);
    }

    public function previsualizaciones ( ) {
        return $this->hasMany(Previsualizacion::class);
    }

    public function secciones_marcadas ( ) {
        return $this->hasMany(SeccionMarcada::class);
    }

    public function cajas_comentarios_marcadas ( ) {
        return $this->hasMany(CajaComentariosMarcada::class);
    }
}