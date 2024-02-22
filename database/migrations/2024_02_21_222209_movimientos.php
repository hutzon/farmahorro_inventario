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
        //
        Schema::create('movimientos', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('lote_id')->unsigned();
            $table->enum('tipo', ['entrada', 'salida']);
            $table->integer('cantidad');
            $table->datetime('fecha');
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('movimientos');
    }
};