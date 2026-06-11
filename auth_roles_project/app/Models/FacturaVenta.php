<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacturaVenta extends Model
{
    protected $table = 'factura_venta';
    protected $primaryKey = 'Id_Fact';

    protected $fillable = [
        'Fecha_Fact',
        'Subtotal_Fact',
        'Iva_Fact',
        'Total_Fact',
        'Id_Cli_FK_FACTURA_VENTA',
        'Estado_Fact',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'Id_Cli_FK_FACTURA_VENTA', 'Id_Cli');
    }
}
