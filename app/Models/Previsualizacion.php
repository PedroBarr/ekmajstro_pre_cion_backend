<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Previsualizacion extends Model
{
    use HasFactory;

    protected $table = "previsualizaciones";
    protected $primaryKey = 'prev_id';

    protected $fillable = [
        "prev_img_miniatura_uri",
        "prev_resumen",
        "prev_descripcion",
        "rec_id",
        "pblc_id"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function recursos ( ) {
        return $this->belongsTo(Recurso::class);
    }

    public function publicaciones ( ) {
        return $this->belongsTo(Publicacion::class);
    }

    public function fechas_publicaciones ( ) {
        return $this
            ->belongsTo(
                Publicacion::class,
                'pblc_id',
                'pblc_id'
            )
            ->select(
                'pblc_id',
                'pblc_fecha_publicacion'
            )
        ;
    }
    
    public function segmentos_publicaciones ( ) {
        return $this
            ->belongsTo(
                Publicacion::class,
                'pblc_id',
                'pblc_id'
            )
            ->with('segmentos')
        ;
    }
}