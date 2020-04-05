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
            'nama_tagihan' => 'SPP 2017/2018',
            'slug' => Str::slug('SPP 2017/2018','-'),
            'nominal' => 3600000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        TipeTagihan::create([
            'nama_tagihan' => 'SPP 2018/2019',
            'slug' => Str::slug('SPP 2018/2019','-'),
            'nominal' => 3600000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        TipeTagihan::create([
            'nama_tagihan' => 'SPP 2019/2020',
            'slug' => Str::slug('SPP 2019/2020','-'),
            'nominal' => 3600000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        TipeTagihan::create([
            'nama_tagihan' => 'SPP 2020/2021',
            'slug' => Str::slug('SPP 2020/2021','-'),
            'nominal' => 3600000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        TipeTagihan::create([
            'nama_tagihan' => 'SPP 2021/2022',
            'slug' => Str::slug('SPP 2021/2022','-'),
            'nominal' => 3600000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        TipeTagihan::create([
            'nama_tagihan' => 'Uang Bangunan',
            'slug' => Str::slug('Uang Bangunan','-'),
            'nominal' => 6000000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
