<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';

    protected $primaryKey = 'Id_Inven';

    protected $fillable = [
        'Precio_Com',
        'Precio_Ven',
        'Stock',
        'Categoria',
        'Descripcion',
        'Id_Proveedor',
        'Id_Producto',
        'Id_Com_FK',
    ];

    public function proveedor()
    {
        return $this->belongsTo(
            Proveedor::class,
            'Id_Proveedor',
            'Id_Prov'
        );
    }

    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'Id_Producto',
            'Id_pro'
        );
    }
}
