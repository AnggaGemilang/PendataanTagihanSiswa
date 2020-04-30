<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tagihan', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('siswa_id')->unsigned();
            $table->bigInteger('kelas_id')->unsigned();
            $table->bigInteger('tipetagihan_id')->unsigned();
            $table->bigInteger('sudah_dibayar')->unsigned();
            $table->enum('keterangan', ['lunas','blm_lunas']);
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
        Schema::dropIfExists('t_tagihan');
    }
}
