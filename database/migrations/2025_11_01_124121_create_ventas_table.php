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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha'); // Fecha de la venta
            $table->unsignedBigInteger('usuario_id')->nullable(); // vendedor o usuario que realiza la venta
            $table->decimal('total', 10, 2)->default(0); // total de la venta
            $table->string('metodo_pago')->nullable(); // opcional: efectivo, tarjeta, etc.
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
