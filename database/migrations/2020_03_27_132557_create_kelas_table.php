<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_kelas', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_kelas', 200);
            $table->integer('tipekelas_id');
            $table->string('slug', 200);
            $table->string('jurusan', 200);
            $table->string('wali_kelas', 200);
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
        Schema::dropIfExists('t_kelas');
    }
}
