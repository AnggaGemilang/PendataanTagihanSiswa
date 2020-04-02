<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tipekelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tipekelas', 225);
            $table->string('desc', 225);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_tipekelas');
    }
}
