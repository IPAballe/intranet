<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metros', function (Blueprint $table) {
            $table->id();
            $table->string('metro_desc');
            $table->float('fc')->default('1');
            $table->boolean('totaliza');
            $table->boolean('activo');
            $table->string('cto_gto1',10)->nullable('true');
            $table->string('cto_gto2',10)->nullable('true');
            $table->string('cto_gto3',10)->nullable('true');

            $table->unsignedBigInteger('entidad_id');
            $table->foreign('entidad_id')
                  ->references('id')
                  ->on('Entidades')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')
                  ->references('id')
                  ->on('Tipos')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metros');
    }
}
