<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagihanTrigger extends Migration
{
    public function up()
    {
        DB::unprepared('CREATE TRIGGER add_tagihan AFTER INSERT ON `t_siswa` FOR EACH ROW
                BEGIN
                   INSERT INTO `t_tagihan` (`id`,`siswa_id`,`tipetagihan_id`,`sudah_dibayar`,`keterangan`,`created_at`,`updated_at`) VALUES (NULL,NEW.id,1,0,"blm_lunas", NULL, NULL);
                   INSERT INTO `t_tagihan` (`id`,`siswa_id`,`tipetagihan_id`,`sudah_dibayar`,`keterangan`,`created_at`,`updated_at`) VALUES (NULL,NEW.id,2,0,"blm_lunas", NULL, NULL);
                END');
    }
    public function down()
    {
        DB::unprepared('DROP TRIGGER `add_tagihan`');
    }
}
