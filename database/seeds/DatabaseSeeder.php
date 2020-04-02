<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KelasSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(TipeTagihanSeeder::class);
        $this->call(PetugasSeeder::class);
        $this->call(TipeKelasSeeder::class);
    }
}
