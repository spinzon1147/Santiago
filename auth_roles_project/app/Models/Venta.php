<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';

    protected $primaryKey = 'Id_Ven';

    public $timestamps = false;

    protected $fillable = [
        'Valor_Ven',
        'Fecha_Ven',
        'Cant_Ven'
    ];
}