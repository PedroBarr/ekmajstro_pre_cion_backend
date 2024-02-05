<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecificacionRecurso extends Model
{
    use HasFactory;

    protected $table = "especificaciones_recurso";
    protected $primaryKey = 'espc_id';

    protected $fillable = [
        "espc_descripcin"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function recursos ( ) {
        return $this->hasMany(Recurso::class);
    }
}