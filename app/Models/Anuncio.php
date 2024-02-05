<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $table = "anuncios";
    protected $primaryKey = 'anun_id';

    protected $fillable = [
        "anun_img_cuerpo_uri",
        "anun_enlace_uri",
        "anun_medida"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}
