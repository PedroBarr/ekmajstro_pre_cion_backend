<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRecurso extends Model
{
    use HasFactory;

    protected $table = "tipos_recurso";
    protected $primaryKey = 'tp_rec_id';

    protected $fillable = [
        "tp_rec_nombre",
        "tp_rec_descripcion",
        "tp_rec_diminutivo"
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