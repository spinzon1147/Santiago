<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('ventas', function (Blueprint $table) {
        if (!Schema::hasColumn('ventas', 'Id_Prod_FK')) {
            $table->unsignedBigInteger('Id_Prod_FK')->nullable();
        }
    });
}

public function down(): void
{
    Schema::table('ventas', function (Blueprint $table) {

        $table->dropForeign(['Id_Prod_FK']);
        $table->dropColumn('Id_Prod_FK');
    });
}
};