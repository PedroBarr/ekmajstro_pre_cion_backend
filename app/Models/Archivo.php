<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = "archivos";
    protected $primaryKey = 'arch_id';

    protected $fillable = [
        "arch_uri",
        "arch_mime",
        "arch_extension",
        "arch_size",
        "arch_name"
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