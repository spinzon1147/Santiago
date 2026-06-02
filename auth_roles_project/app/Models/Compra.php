<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra';

    protected $primaryKey = 'Id_Com';

    public $timestamps = false;

    protected $fillable = [
        'Valor_Com',
        'Fecha_Com',
        'Cant_Com'
    ];
}