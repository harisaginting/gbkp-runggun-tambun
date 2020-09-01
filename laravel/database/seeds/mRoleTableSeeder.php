<?php

use Illuminate\Database\Seeder;

class mRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('m_role')->insert(['nama' => 'anggota']);
      DB::table('m_role')->insert(['nama' => 'admin']);
      DB::table('m_role')->insert(['nama' => 'tamu']);
    }
}
