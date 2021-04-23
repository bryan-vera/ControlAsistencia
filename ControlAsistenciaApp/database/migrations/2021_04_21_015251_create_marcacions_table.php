<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcacions', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('codigoEmpleado',false,5);
            $table->string('tipoMarcacion',20);
            $table->dateTime('fechaHora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcacions');
    }
}
