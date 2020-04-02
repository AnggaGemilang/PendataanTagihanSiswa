<?php

use Illuminate\Database\Seeder;
use App\TipeKelas;
use Carbon\Carbon;

class TipeKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeKelas::create([
            'nama_tipekelas' => 'X',
            'desc' => 'Sepuluh',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        TipeKelas::create([
            'nama_tipekelas' => 'XI',
            'desc' => 'Sebelas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        TipeKelas::create([
            'nama_tipekelas' => 'XII',
            'desc' => 'Dua Belas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
