<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('compra', function (Blueprint $table) {

            $table->unsignedBigInteger('Id_Prod_FK')->nullable();

            $table->foreign('Id_Prod_FK')
                ->references('Id_pro')
                ->on('producto');
        });
    }

    public function down(): void
    {
        Schema::table('compra', function (Blueprint $table) {

            $table->dropForeign(['Id_Prod_FK']);
            $table->dropColumn('Id_Prod_FK');
        });
    }
};