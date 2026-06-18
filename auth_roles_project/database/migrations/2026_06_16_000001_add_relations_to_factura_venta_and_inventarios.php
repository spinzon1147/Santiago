<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('factura_venta', 'Id_Ven_FK')) {
            Schema::table('factura_venta', function (Blueprint $table) {
                $table->unsignedBigInteger('Id_Ven_FK')->nullable()->after('Id_Cli_FK_FACTURA_VENTA');
                $table->foreign('Id_Ven_FK')->references('Id_Ven')->on('ventas')->nullOnDelete();
            });
        }

        if (!Schema::hasColumn('inventarios', 'Id_Com_FK')) {
            Schema::table('inventarios', function (Blueprint $table) {
                $table->unsignedInteger('Id_Com_FK')->nullable()->after('Id_Producto');
                $table->foreign('Id_Com_FK')->references('Id_Com')->on('compra')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('factura_venta', 'Id_Ven_FK')) {
            Schema::table('factura_venta', function (Blueprint $table) {
                $table->dropForeign(['Id_Ven_FK']);
                $table->dropColumn('Id_Ven_FK');
            });
        }

        if (Schema::hasColumn('inventarios', 'Id_Com_FK')) {
            Schema::table('inventarios', function (Blueprint $table) {
                $table->dropForeign(['Id_Com_FK']);
                $table->dropColumn('Id_Com_FK');
            });
        }
    }
};
