<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Make Descrip_pro nullable (productos form allows empty)
        Schema::table('producto', function (Blueprint $table) {
            $table->string('Descrip_pro', 250)->nullable()->change();
        });

        // Make Tel_Cli string instead of bigInteger (handles formatted phone numbers)
        Schema::table('cliente', function (Blueprint $table) {
            $table->string('Tel_Cli', 30)->change();
        });

        // Make Tel_Prov string instead of bigInteger
        Schema::table('proveedors', function (Blueprint $table) {
            $table->string('Tel_Prov', 30)->change();
        });
    }

    public function down(): void
    {
        Schema::table('producto', function (Blueprint $table) {
            $table->string('Descrip_pro', 250)->nullable(false)->change();
        });

        Schema::table('cliente', function (Blueprint $table) {
            $table->bigInteger('Tel_Cli')->change();
        });

        Schema::table('proveedors', function (Blueprint $table) {
            $table->unsignedBigInteger('Tel_Prov')->change();
        });
    }
};
