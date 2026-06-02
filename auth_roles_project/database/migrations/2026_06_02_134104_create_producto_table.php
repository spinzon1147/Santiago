<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('Id_pro');
            $table->string('Nom_pro', 40);
            $table->bigInteger('Cant_pro');
            $table->string('Estado_pro', 10);
            $table->string('Descrip_pro', 250);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('producto');
    }
};