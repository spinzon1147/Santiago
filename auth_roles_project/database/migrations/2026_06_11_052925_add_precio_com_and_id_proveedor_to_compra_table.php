<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('compra', function (Blueprint $table) {
            $table->integer('Precio_Com')->nullable()->after('Valor_Com');
            $table->unsignedBigInteger('Id_Proveedor')->nullable()->after('Id_Prod_FK');

            $table->foreign('Id_Proveedor')
                ->references('Id_Prov')
                ->on('proveedors');
        });
    }

    public function down(): void
    {
        Schema::table('compra', function (Blueprint $table) {
            $table->dropForeign(['Id_Proveedor']);
            $table->dropColumn('Id_Proveedor');
            $table->dropColumn('Precio_Com');
        });
    }
};
