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
            'nisn' => 201931203,
            'nama_siswa' => 'David Angga',
            'slug' => Str::slug('David Angga','-'),
            'alamat' => '450 Serra Mall, Stanford, CA 94305, United States',
            'kelas_id' => 1,
            'tipekelas_id' => 1,
            'no_telp' => '081195008215',
            'profil' => 'david-profil.png',
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Siswa::create([
            'nisn' => 201831203,
            'nama_siswa' => 'Steven Angga',
            'slug' => Str::slug('Steven Angga','-'),
            'alamat' => 'Oxford Rd, Manchester M13 9PL, United Kingdom',
            'kelas_id' => 14,
            'tipekelas_id' => 2,
            'no_telp' => '082195008216',
            'profil' => 'steven-profil.jpeg',
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Siswa::create([
            'nisn' => 201731203,
            'nama_siswa' => 'Angga Gemilang',
            'slug' => Str::slug('Angga Gemilang','-'),
            'alamat' => 'Jalan Ciguruwik Babakan Sukamulya RT. 02 RW. 13 No. 53',
            'kelas_id' => 27,
            'tipekelas_id' => 3,
            'no_telp' => '083195008217',
            'profil' => 'angga-profil.JPG',
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
