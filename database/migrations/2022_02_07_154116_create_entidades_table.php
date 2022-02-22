<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidades', function (Blueprint $table) {
            $table->id();

            $table->string('entidad_desc', 30);
            $table->string('correo', 50)->nullable('true');
            $table->string('telefono', 30)->nullable('true');

            $table->unsignedBigInteger('munic_id');
            $table->foreign('munic_id')
                  ->references('id')
                  ->on('municipios')
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
        Schema::dropIfExists('entidades');
    }
}
