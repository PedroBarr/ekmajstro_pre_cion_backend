<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPermiso extends Model
{
    use HasFactory;

    protected $table = "tipos_permiso";
    protected $primaryKey = 'tp_perm_id';

    protected $fillable = [
        "tp_perm_nombre",
        "tp_perm_descripcion"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    //relaciones
    public function recursos ( ) {
        return $this->hasMany(Recurso::class);
    }

    public function usuarios ( ) {
        return $this->hasMany(Usuario::class);
    }
}