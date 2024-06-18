<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        );
    }

    public function secciones_marcadas ( ) {
        return $this->hasMany(SeccionMarcada::class);
    }
}