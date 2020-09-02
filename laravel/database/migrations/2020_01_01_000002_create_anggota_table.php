<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->integer('role')->default(0);
            $table->string('email')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('runggun')->nullable();
            $table->integer('sektor')->nullable();
            $table->string('nama_depan')->nullable();
            $table->string('nama_belakang')->nullable();
            $table->string('nama_panggilan')->nullable();
            $table->integer('marga')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_meninggal')->nullable();
            $table->string('jenis_kelamin',20)->nullable()->default('L');
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->string('domisili_kecamatan')->nullable();
            $table->string('domisili_kota')->nullable();
            $table->string('domisili_provinsi')->nullable();
            $table->integer('status_pernikahan')->default(0);
            $table->string('kategorial',22)->nullable();
            $table->integer('pekerjaan')->nullable();
            $table->integer('pendidikan')->nullable();
            $table->string('perusahaan',50)->nullable();
            $table->integer('tahun_ngawan')->nullable()->default(date('Y'));
            $table->string('runggun_ngawan')->nullable()->default('TAMBUN');
            $table->string('hobi')->nullable();
            $table->string('instagram')->nullable();
            $table->longtext('avatar',3000)->nullable();
            $table->string('status',20)->default('TERDAFTAR');
            $table->string('confirmation')->nullable();
            $table->integer('isDeleted')->default(0);
            $table->integer('visible')->default(1);
            $table->string('password')->default('$2y$10$ItWUDs5mbIn0bPjwsFvDTeEeqY26ZVcBC2eotNNZ0NUut5QmelPgu');
            $table->string('token')->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
