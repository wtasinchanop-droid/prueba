<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('precio_base', 10, 2)->default(0)->after('cantidad');
            $table->decimal('iva_porcentaje', 5, 2)->default(15.00)->after('precio_base');
            $table->decimal('precio_con_iva', 10, 2)->default(0)->after('iva_porcentaje');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn(['precio_base', 'iva_porcentaje', 'precio_con_iva']);
        });
    }
};