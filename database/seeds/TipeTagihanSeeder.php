<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\TipeTagihan;
use Carbon\Carbon;

class TipeTagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TipeTagihan::create([
            'nama_tagihan' => 'SPP',
            'slug' => Str::slug('SPP','-'),
            'nominal' => 3600000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        TipeTagihan::create([
            'nama_tagihan' => 'Uang Bangunan',
            'slug' => Str::slug('Uang Bangunan'),
            'nominal' => 6000000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
