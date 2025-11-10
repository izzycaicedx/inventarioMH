<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'usuario_id',
        'total',
        'metodo_pago'
    ];

    protected $casts = [
        'fecha' => 'datetime', // ← ESTA LÍNEA ES IMPORTANTE
        'total' => 'decimal:2'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
