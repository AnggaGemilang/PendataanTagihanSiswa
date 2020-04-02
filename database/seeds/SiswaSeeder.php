<?php

use Illuminate\Database\Seeder;
use App\Siswa;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create([
            'nis' => 1718117111,
            'nisn' => 201231203,
            'nama_siswa' => 'Angga Gemilang',
            'slug' => Str::slug('Angga Gemilang','-'),
            'alamat' => 'Jalan Ciguruwik Babakan Sukamulya RT. 02 RW. 13 No. 53',
            'kelas_id' => 1,
            'no_telp' => '083195008217',
            'email' => 'angga@mail.id',
            'password' => Hash::make('123456789'),
            'profil' => '',
            'tipekelas_id' => 1,
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
