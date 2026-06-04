<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('ventas', function (Blueprint $table) {
        if (!Schema::hasColumn('ventas', 'Cant_Ven')) {
            $table->integer('Cant_Ven')->after('Id_Prod_FK');
        }
    });
}

public function down(): void
{
    Schema::table('ventas', function (Blueprint $table) {
        $table->dropColumn('Cant_Ven');
    });
}
};
