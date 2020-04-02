<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Kelas;
use Carbon\Carbon;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'nama_kelas' => 'X-RPL 1',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-RPL 1','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-RPL 2',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-RPL 2','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-RPL 3',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-RPL 3','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-TKJ 1',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-TKJ 1','-'),
            'jurusan' => 'Teknik Komputer Jaringan',
            'wali_kelas' => 'guru 4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-MM 1',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-MM 1','-'),
            'jurusan' => 'Multimedia',
            'wali_kelas' => 'guru 5',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-AV 1',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-AV 1','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-AV 2',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-AV 2','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-AV 3',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-AV 3','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-AV 4',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-AV 4','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 9',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-TOI 1',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-TOI 1','-'),
            'jurusan' => 'Teknik Otomasi Industri',
            'wali_kelas' => 'guru 10',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-TOI 2',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-TOI 2','-'),
            'jurusan' => 'Teknik Otomasi Industri',
            'wali_kelas' => 'guru 11',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-TITIL 1',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-TITIL 1','-'),
            'jurusan' => 'Teknik Instalasi Tenaga Listrik',
            'wali_kelas' => 'guru 12',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'X-TITL 2',
            'tipekelas_id' => 1,
            'slug' => Str::slug('X-TITL 2','-'),
            'jurusan' => 'Teknik Instalasi Tenaga Listrik',
            'wali_kelas' => 'guru 13',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);



        Kelas::create([
            'nama_kelas' => 'XI-RPL 1',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-RPL 1','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 14',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-RPL 2',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-RPL 2','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 15',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-RPL 3',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-RPL 3','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 16',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-TKJ 1',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-TKJ 1','-'),
            'jurusan' => 'Teknik Komputer Jaringan',
            'wali_kelas' => 'guru 17',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-MM 1',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-MM 1','-'),
            'jurusan' => 'Multimedia',
            'wali_kelas' => 'guru 18',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-AV 1',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-AV 1','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 19',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-AV 2',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-AV 2','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 20',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-AV 3',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-AV 3','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 21',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-AV 4',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-AV 4','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 22',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-TOI 1',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-TOI 1','-'),
            'jurusan' => 'Teknik Otomasi Industri',
            'wali_kelas' => 'guru 23',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-TOI 2',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-TOI 2','-'),
            'jurusan' => 'Teknik Otomasi Industri',
            'wali_kelas' => 'guru 24',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-TITIL 1',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-TITIL 1','-'),
            'jurusan' => 'Teknik Instalasi Tenaga Listrik',
            'wali_kelas' => 'guru 25',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XI-TITL 2',
            'tipekelas_id' => 2,
            'slug' => Str::slug('XI-TITL 2','-'),
            'jurusan' => 'Teknik Instalasi Tenaga Listrik',
            'wali_kelas' => 'guru 26',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-RPL 1',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-RPL 1','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 27',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-RPL 2',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-RPL 2','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 28',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-RPL 3',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-RPL 3','-'),
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'wali_kelas' => 'guru 29',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-TKJ 1',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-TKJ 1','-'),
            'jurusan' => 'Teknik Komputer Jaringan',
            'wali_kelas' => 'guru 30',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-MM 1',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-MM 1','-'),
            'jurusan' => 'Multimedia',
            'wali_kelas' => 'guru 31',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-AV 1',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-AV 1','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 32',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-AV 2',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-AV 2','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 33',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-AV 3',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-AV 3','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 34',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-AV 4',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-AV 4','-'),
            'jurusan' => 'Teknik Audio Video',
            'wali_kelas' => 'guru 35',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-TOI 1',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-TOI 1','-'),
            'jurusan' => 'Teknik Otomasi Industri',
            'wali_kelas' => 'guru 36',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-TOI 2',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-TOI 2','-'),
            'jurusan' => 'Teknik Otomasi Industri',
            'wali_kelas' => 'guru 37',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-TITIL 1',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-TITIL 1','-'),
            'jurusan' => 'Teknik Instalasi Tenaga Listrik',
            'wali_kelas' => 'guru 38',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-TITL 2',
            'tipekelas_id' => 3,
            'slug' => Str::slug('XII-TITL 2','-'),
            'jurusan' => 'Teknik Instalasi Tenaga Listrik',
            'wali_kelas' => 'guru 39',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
