<?php

use Illuminate\Database\Seeder;
use App\Role;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'nama_role' => 'siswa',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        Role::create([
            'nama_role' => 'admin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        Role::create([
            'nama_role' => 'petugas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
