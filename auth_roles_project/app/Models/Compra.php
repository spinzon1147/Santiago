<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compra extends Model
{
    protected $table = 'compra';
    protected $primaryKey = 'Id_Com';

    public $timestamps = false;

    protected $fillable = [
        'Valor_Com',
        'Fecha_Com',
        'Cant_Com',
        'Precio_Com',
        'Id_Prod_FK',
        'Id_Proveedor',
    ];

    protected $casts = [
        'Valor_Com' => 'decimal:2',
        'Precio_Com' => 'decimal:2',
        'Cant_Com' => 'integer',
        'Fecha_Com' => 'date',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'Id_Prod_FK', 'Id_pro');
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'Id_Proveedor', 'Id_Prov');
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('Fecha_Com', $date);
    }
}
