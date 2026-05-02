<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoVerificacion extends Model
{
    protected $fillable = [
        'usuario_id',
        'codigo',
        'expiracion'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}