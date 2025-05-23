<?php

namespace App\Models;

use DB;
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
        return $this->hasMany(
          Previsualizacion::class,
          'pblc_id',
          'pblc_id'
        );
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

    public function segmentos ( ) {
        return $this->hasMany(
          Seccion::class,
          'pblc_id',
        )
          ->with('segmentos')
        ;
    }

    //relaciones
    public function recursos_con_tipo ( ): BelongsToMany {
      return $this
        ->belongsToMany(
          Recurso::class,
          'recurso_publicacion',
          'pblc_id',
          'rec_id',
        )
        ->with('tipos')
        ->with('archivos')
      ;
    }
    
    //relaciones
    public function recursos_con_todo ( ): BelongsToMany {
      return $this
        ->belongsToMany(
          Recurso::class,
          'recurso_publicacion',
          'pblc_id',
          'rec_id',
        )
        ->with('tipos')
        ->with('archivos')
        ->with('especificaciones')
      ;
    }

    public static function con_previsualizacion ( ) {
      return self::select(
          'publicaciones.*',
          DB::raw('IF (previsualizaciones.prev_id IS NULL, FALSE, TRUE) AS con_previsualizacion')
        )
        ->leftjoin('previsualizaciones', 'publicaciones.pblc_id', '=', 'previsualizaciones.pblc_id')
        ->get()
      ;
    }

    public function secciones_lista ( ) {
        return $this->hasMany(
          Seccion::class,
          'pblc_id',
        )
          ->withExists('secciones_marcadas')
          ->orderBy('secciones_marcadas_exists', 'desc')
        ;
    }

    public function previsualizacion ( ) {
        return $this->hasOne(
          Previsualizacion::class,
          'pblc_id',
          'pblc_id'
        );
    }

    public static function marcar_seccion ($pblc_id, $secc_id) {
        $existe = SeccionMarcada::where('pblc_id', $pblc_id)
          ->where('secc_id', $secc_id)
          ->exists();

        if ($existe) return;

        $existe = SeccionMarcada::where('pblc_id', $pblc_id)
          ->first();

        if ($existe) {
            SeccionMarcada::where('pblc_id', $pblc_id)
              ->update(['secc_id' => $secc_id]);
        } else {
            SeccionMarcada::create([
              'pblc_id' => $pblc_id,
              'secc_id' => $secc_id
            ]);
        }
    }

    public static function desmarcar_seccion ($pblc_id, $secc_id) {
        $existe = SeccionMarcada::where('pblc_id', $pblc_id)
          ->where('secc_id', $secc_id)
          ->exists();

        if ($existe) {
            SeccionMarcada::where('pblc_id', $pblc_id)
              ->where('secc_id', $secc_id)
              ->delete();
        }
    }

}