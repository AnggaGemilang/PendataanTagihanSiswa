<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTagihanPembayaranTrigger extends Migration
{
    public function up()
    {
        DB::unprepared('CREATE TRIGGER change_tagihan_pembayaran AFTER INSERT ON `t_pembayaran` FOR EACH ROW
                BEGIN
                   UPDATE t_tagihan SET sudah_dibayar = sudah_dibayar + NEW.nominal WHERE id = NEW.tagihan_id;
                END');
    }
    public function down()
    {
        DB::unprepared('DROP TRIGGER `change_tagihan_pembayaran`');
    }
}
