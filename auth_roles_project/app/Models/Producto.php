<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Venta;
use App\Models\Compra;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'Id_pro';

    protected $fillable = [
        'Nom_pro',
        'Cant_pro',
        'Precio_pro',
        'Estado_pro',
        'Descrip_pro'
    ];

    // 📦 relación con ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'Id_Prod_FK', 'Id_pro');
    }

    // 🛒 relación con compras
    public function compras()
    {
        return $this->hasMany(Compra::class, 'Id_Prod_FK', 'Id_pro');
    }
}