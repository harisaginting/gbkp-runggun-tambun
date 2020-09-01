<?php

use Illuminate\Database\Seeder;

class AnggotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anggota')->insert(
        	['id' => 0, 'role' => 1, 'nama_depan' => 'super-admin','username' => 'admin','visible'=> 0]
        	);
        // password : permatatambun
    }
}
