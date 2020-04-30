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
            $table->integer('sisa_tagihan')->unsigned()->nullable();
            $table->string('keterangan');
            $table->integer('siswa_id')->unsigned();
            $table->integer('petugas_id')->unsigned();
            $table->integer('tipetagihan_id')->unsigned();
            $table->integer('tagihan_id')->unsigned();
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
