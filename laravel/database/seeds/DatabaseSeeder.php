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
        $this->call(mGeneralTableSeeder::class);
        $this->call(mRoleTableSeeder::class);
        $this->call(AnggotaTableSeeder::class);

        $lokasi             = base_path().'/../setup/data_lokasi.sql';
        DB::unprepared(file_get_contents($lokasi));
        $anggota_permata    = base_path().'/../setup/anggota_permata.sql';
        DB::unprepared(file_get_contents($anggota_permata));
        $this->command->info('Country table seeded!');
    }
}
