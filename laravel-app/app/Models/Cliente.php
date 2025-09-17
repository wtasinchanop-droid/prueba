<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'nombre', 'numeroTelefono'];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'codigo_cliente', 'codigo');
    }
}
