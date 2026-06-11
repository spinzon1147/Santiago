<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ventas', function (Blueprint $table) {
    $table->id('Id_Ven');
    $table->unsignedBigInteger('Id_Prod_FK');
    $table->integer('Cant_Ven');
    $table->decimal('Total_Ven', 12, 2);
    $table->dateTime('Fecha_Ven');
    $table->timestamps();
    $table->foreign('Id_Prod_FK')
        ->references('Id_pro')
        ->on('producto');
});
    }
    public function down(): void {
        Schema::dropIfExists('ventas');
    }
};