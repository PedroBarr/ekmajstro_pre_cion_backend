<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Seccion extends Model
{
    use HasFactory;

    protected $table = "secciones";
    protected $primaryKey = 'secc_id';

    protected $fillable = [
        "secc_nombre",
        "pblc_id"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function publicaciones ( ) {
        return $this->belongsTo(Publicacion::class);
    }

    public function segmentos ( ) {
        return $this->hasMany(
          Segmento::class,
          'secc_id',
        )
          ->orderBy('segm_posicion')
        ;
    }

    public function secciones_marcadas ( ) {
        return $this->hasMany(
          SeccionMarcada::class,
          'secc_id',
        );
    }

    public static function con_seccion_marcada ($secc_id) {
        return self::select(
          'secciones.*',
          DB::raw('IF (secciones_marcadas.secc_id IS NULL, FALSE, TRUE) AS con_seccion_marcada')
        )
          ->leftJoin(
            'secciones_marcadas',
            'secciones.secc_id',
            '=',
            'secciones_marcadas.secc_id'
          )
          ->where('secciones.secc_id', $secc_id)
          // ->with('segmentos')
          ->first();
    }
}