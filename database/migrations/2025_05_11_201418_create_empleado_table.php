<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('empleado', function (Blueprint $table) {
    $table->id('idEmpleado');
    $table->integer('DNI')->unique();
    $table->string('NombreEmpleado', 45);
    $table->string('ApellidopEmpleado', 45);
    $table->string('ApellidomEmpleado', 45);
    $table->string('TelefonoEmpleado', 45);
    $table->string('RolEmpleado', 45);
    $table->string('ActivoEmpleado', 45);
    $table->string('ContrasenaEmpleado', 255)->nullable();
    $table->timestamps(); // si lo necesitas
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleado', function (Blueprint $table) {
            //
        });
    }
};
