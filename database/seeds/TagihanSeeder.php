<?php

use Illuminate\Database\Seeder;
use App\Tagihan;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TagihanSeeder extends Seeder
{
    public function run()
    {
        Tagihan::create([
            'siswa_id' => 1,
            'tipetagihan_id' => 3,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Tagihan::create([
            'siswa_id' => 1,
            'tipetagihan_id' => 4,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Tagihan::create([
            'siswa_id' => 1,
            'tipetagihan_id' => 5,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Tagihan::create([
            'siswa_id' => 2,
            'tipetagihan_id' => 2,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Tagihan::create([
            'siswa_id' => 2,
            'tipetagihan_id' => 3,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Tagihan::create([
            'siswa_id' => 2,
            'tipetagihan_id' => 4,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Tagihan::create([
            'siswa_id' => 3,
            'tipetagihan_id' => 1,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Tagihan::create([
            'siswa_id' => 3,
            'tipetagihan_id' => 2,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Tagihan::create([
            'siswa_id' => 3,
            'tipetagihan_id' => 3,
            'sudah_dibayar' => 0,
            'keterangan' => 'blm_lunas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
