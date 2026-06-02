<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('compra', function (Blueprint $table) {
            $table->increments('Id_Com');
            $table->integer('Valor_Com');
            $table->date('Fecha_Com')->nullable();
            $table->integer('Cant_Com');
            $table->unsignedBigInteger('Id_producto')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('compra');
    }
};