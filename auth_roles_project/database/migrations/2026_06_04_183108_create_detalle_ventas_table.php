<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('Id_Ven_FK');
    $table->unsignedBigInteger('Id_Prod_FK');

    $table->integer('Cantidad');
    $table->decimal('Precio', 12, 2);
    $table->decimal('Subtotal', 12, 2);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
