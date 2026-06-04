<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'Id_Ven';

    protected $fillable = [
        'Id_Prod_FK',
        'Cant_Ven',
        'Total_Ven',
        'Fecha_Ven',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_Prod_FK', 'Id_pro');
    }
}