<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function recursos ( ): BelongsToMany {
        return $this->belongsToMany(
          Recurso::class,
          'recurso_publicacion',
          'pblc_id',
          'rec_id',
        );
    }

    public function etiquetas ( ): BelongsToMany {
        return $this->belongsToMany(
          Etiqueta::class,
          'etiqueta_publicacion',
          'pblc_id',
          'etq_id',
        );
    }

    public function previsualizaciones ( ) {
        return $this->hasMany(Previsualizacion::class);
    }

    public function secciones ( ) {
        return $this->hasMany(
          Seccion::class,
          'pblc_id',
        )
          ->with('segmentos')
          ->withExists('secciones_marcadas')
          ->orderBy('secciones_marcadas_exists', 'desc')
        ;
    }

    public function secciones_marcadas ( ) {
        return $this->hasMany(SeccionMarcada::class);
    }

    public function cajas_comentarios_marcadas ( ) {
        return $this->hasMany(CajaComentariosMarcada::class);
    }
}