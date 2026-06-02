<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('venta', function (Blueprint $table) {
            $table->bigIncrements('Id_Ven');
            $table->bigInteger('Valor_Ven');
            $table->date('Fecha_Ven');
            $table->integer('Cant_Ven');
            $table->unsignedBigInteger('Id_Fact_FK_VENTA')->nullable();
            $table->string('Estado_Ven', 10)->nullable();
            $table->timestamps();
            $table->foreign('Id_Fact_FK_VENTA')->references('Id_Fact')->on('factura_venta');
        });
    }
    public function down(): void {
        Schema::dropIfExists('venta');
    }
};