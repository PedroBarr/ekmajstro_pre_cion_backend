<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionMarcada extends Model
{
    use HasFactory;

    protected $table = "secciones_marcadas";
    protected $primaryKey = 'secc_marc_id';

    protected $fillable = [
        "pblc_id",
        "secc_id"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function publicaciones ( ) {
        return $this->belongsTo(Publicacion::class);
    }

    public function secciones ( ) {
        return $this->belongsTo(Seccion::class);
    }
}