<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cliente', function (Blueprint $table) {
            $table->bigIncrements('Id_Cli');
            $table->string('Nom_Cli', 30);
            $table->string('Email_Cli', 30);
            $table->bigInteger('Tel_Cli');
            $table->string('Direc_Cli', 30);
            $table->string('Estado_Cli', 10);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('cliente');
    }
};