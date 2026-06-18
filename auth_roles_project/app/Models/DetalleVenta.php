<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';

    protected $fillable = [
        'Id_Ven_FK',
        'Id_Prod_FK',
        'Cantidad',
        'Precio',
        'Subtotal'
    ];
}
