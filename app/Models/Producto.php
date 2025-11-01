<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'cantidad',   // stock disponible
        'precio',
    ];

    /**
     * Relación con los detalles de venta.
     * Un producto puede estar en muchas ventas.
     */
    public function detallesVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    /**
     * Descontar stock al vender un producto.
     */
    public function descontarStock($cantidad)
    {
        $this->cantidad -= $cantidad;
        if ($this->cantidad < 0) {
            $this->cantidad = 0;
        }
        $this->save();
    }
}

