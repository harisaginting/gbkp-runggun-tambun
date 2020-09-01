<?php

use Illuminate\Database\Seeder;

class mGeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_general')->insert(['type' => 'sektor','value' => 'Bumi Lestari']);
        DB::table('m_general')->insert(['type' => 'sektor','value' => 'Graha Prima']);
    	DB::table('m_general')->insert(['type' => 'sektor','value' => 'Cibitung 1']);
    	DB::table('m_general')->insert(['type' => 'sektor','value' => 'Cibitung 2']);
    	DB::table('m_general')->insert(['type' => 'sektor','value' => 'Papan Mas']);
    	DB::table('m_general')->insert(['type' => 'sektor','value' => 'Tridaya']);
    	DB::table('m_general')->insert(['type' => 'sektor','value' => 'Griya Asri']);
    	DB::table('m_general')->insert(['type' => 'marga','value' => 'Ginting']);
    	DB::table('m_general')->insert(['type' => 'marga','value' => 'Karo-karo']);
    	DB::table('m_general')->insert(['type' => 'marga','value' => 'Tarigan']);
    	DB::table('m_general')->insert(['type' => 'marga','value' => 'Perangin-nangin']);
    	DB::table('m_general')->insert(['type' => 'marga','value' => 'Sembiring']);
    	DB::table('m_general')->insert(['type' => 'pekerjaan','value' => 'Pegawai Negri']);
    	DB::table('m_general')->insert(['type' => 'pekerjaan','value' => 'Pegawai Swasta']);
    	DB::table('m_general')->insert(['type' => 'pekerjaan','value' => 'Wiraswasta']);
    	DB::table('m_general')->insert(['type' => 'pekerjaan','value' => 'Pelajar']);
        DB::table('m_general')->insert(['type' => 'pekerjaan','value' => 'Ibu Rumah Tangga']);
        DB::table('m_general')->insert(['type' => 'pekerjaan','value' => 'Pencari Kerja']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'SD']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'SMP']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'SMA/K']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'D1']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'D2']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'D3']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'D4']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'S1']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'S2']);
    	DB::table('m_general')->insert(['type' => 'pendidikan','value' => 'S3']);
        DB::table('m_general')->insert(['type' => 'status_keluarga','value' => 'Suami']);
        DB::table('m_general')->insert(['type' => 'status_keluarga','value' => 'Istri']);
        DB::table('m_general')->insert(['type' => 'status_keluarga','value' => 'Anak']);
        DB::table('m_general')->insert(['type' => 'status_keluarga','value' => 'Keponakan']);
        DB::table('m_general')->insert(['type' => 'status_keluarga','value' => 'Kerabat']);
    }
}
