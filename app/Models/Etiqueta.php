<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;

    protected $table = "etiquetas";
    protected $primaryKey = 'etq_id';

    protected $fillable = [
        "etq_nombre",
        "etq_descripcion"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function publicaciones ( ) {
        return $this->belongsToMany(Publicacion::class);
    }
}