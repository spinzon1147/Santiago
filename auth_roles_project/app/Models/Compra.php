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
        'Cant_Com',
        'Id_Prod_FK'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_Prod_FK', 'Id_pro');
    }
}