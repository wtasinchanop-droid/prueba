<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = ['id_producto', 'codigo_cliente'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'codigo_cliente', 'codigo');
    }
}
