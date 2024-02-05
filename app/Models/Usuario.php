<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * La tabla asociada con el modelo.
     *
     * @variable string
     */
    protected $table = 'users';

    /**
     * La llave primaria asociada con la tabla.
     *
     * @variable string
     */
    protected $primaryKey = 'id';

    /**
     * Los atributos que son  asignables en masa.
     *
     * @variable array<int, string>
     */
    protected $fillable = [
        'nombre',
        'correo',
        'clave_troceada',
        'tp_perm_id',
    ];

    /**
     * Los atributos que deben  estar ocultos para la serializacion.
     *
     * @variable array<int, string>
     */
    protected $hidden = [
        'clave_troceada',
        'remember_token',
        "created_at",
        "updated_at"
    ];

    /**
     * Los atributos que deben emitirse.
     *
     * @variable array<string, string>
     */
    protected $casts = [
        'verificacion_en' => 'datetime',
    ];

    /**
     * Los valores marcados del modelo para los atributos.
     *
     * @variable array
     */
    protected $attributes = [
        'tp_perm_id' => 1,
    ];

    /**
     * Obtiene los comentarios hechos por el comentario.
     */
    public function comentarios ( ) {
        return $this->hasMany(Comentario::class);
    }

    /**
     * Obtiene los tipos de permisos relacionados al usuario.
     */
    public function permisos ( ) {
        return $this->belongsTo(TipoPermiso::class);
    }
}