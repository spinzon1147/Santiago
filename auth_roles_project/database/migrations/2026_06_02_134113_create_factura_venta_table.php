<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('factura_venta', function (Blueprint $table) {
            $table->bigIncrements('Id_Fact');
            $table->date('Fecha_Fact');
            $table->bigInteger('Subtotal_Fact');
            $table->bigInteger('Iva_Fact');
            $table->bigInteger('Total_Fact');
            $table->unsignedBigInteger('Id_Cli_FK_FACTURA_VENTA')->nullable();
            $table->string('Estado_Fact', 10);
            $table->timestamps();
            $table->foreign('Id_Cli_FK_FACTURA_VENTA')->references('Id_Cli')->on('cliente');
        });
    }
    public function down(): void {
        Schema::table('factura_venta', function (Blueprint $table) {
            $table->dropForeign(['Id_Cli_FK_FACTURA_VENTA']);
        });
        Schema::dropIfExists('factura_venta');
    }
};