<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaComentarios extends Model
{
    use HasFactory;

    protected $table = "cajas_comentarios";
    protected $primaryKey = 'caja_comn_id';

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function cajas_comentarios_marcadas ( ) {
        return $this->hasMany(CajaComentariosMarcada::class);
    }
}
