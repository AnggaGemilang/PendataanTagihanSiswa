<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutentikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_autentikasi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_induk');
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->integer('role_id');
            $table->integer('petugas_id')->nullable();
            $table->integer('siswa_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('t_autentikasi');
    }
}
