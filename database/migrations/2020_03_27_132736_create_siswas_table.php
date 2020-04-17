<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_siswa', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('nisn')->unsigned()->nullable();
            $table->string('nama_siswa', 200);
            $table->string('slug', 200);
            $table->text('alamat')->nullable();
            $table->integer('kelas_id')->unsigned();
            $table->integer('tipekelas_id')->unsigned();
            $table->string('no_telp', 13)->nullable();
            $table->string('profil');
            $table->integer('role_id');
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
        Schema::dropIfExists('t_siswa');
    }
}
