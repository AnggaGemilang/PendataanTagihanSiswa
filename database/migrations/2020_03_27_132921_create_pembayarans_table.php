<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pembayaran', function (Blueprint $table) {
            $table->id('id');
            $table->integer('nominal')->unsigned();
            $table->integer('siswa_id')->unsigned();
            $table->integer('kelas_id')->unsigned();
            $table->integer('petugas_id')->unsigned();
            $table->integer('tagihan_id')->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('t_pembayaran');
    }
}
