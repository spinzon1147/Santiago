<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('producto', function ($table) {
        $table->decimal('Precio_pro', 10, 2)->after('Cant_pro');
    });
}

public function down()
{
    Schema::table('producto', function ($table) {
        $table->dropColumn('Precio_pro');
    });
}
};
