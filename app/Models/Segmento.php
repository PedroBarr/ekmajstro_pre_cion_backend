<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    use HasFactory;

    protected $table = "segmentos";
    protected $primaryKey = 'segm_id';

    protected $fillable = [
        "segm_medida",
        "segm_posicion",
        "segm_contenido",
        "secc_id"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function secciones ( ) {
        return $this->belongsTo(Seccion::class);
    }
}