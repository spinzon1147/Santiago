<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {

            $table->id('Id_Inven');

            $table->integer('Precio_Com');
            $table->integer('Precio_Ven');
            $table->integer('Stock');

            $table->string('Categoria', 100)->nullable();
            $table->string('Descripcion', 255)->nullable();

            $table->foreignId('Id_Proveedor')
                ->nullable()
                ->constrained(
                    table: 'proveedors',
                    column: 'Id_Prov'
                )
                ->nullOnDelete();

            $table->foreignId('Id_Producto')
                ->nullable()
                ->constrained(
                    table: 'producto',
                    column: 'Id_Pro'
                )
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('inventarios');
        Schema::enableForeignKeyConstraints();
    }
};
