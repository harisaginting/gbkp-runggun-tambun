<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbadahUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibadah_umum', function (Blueprint $table) {
            $table->bigIncrements('id_ibadah');
            $table->string('nama');
            $table->string('khotbah');
            $table->string('invocatio');
            $table->string('ogen');
            $table->date('tanggal');
            $table->string('waktu_mulai');
            $table->string('waktu_selesai');
            $table->string('tema');
            $table->string('pengkotbah');
            $table->string('liturgi');
            $table->string('koordinator')->nullable();
            $table->string('simabaenden')->nullable();
            $table->string('sinaruh')->nullable();
            $table->string('siermomo')->nullable();
            $table->string('organis')->nullable();
            $table->string('songleader')->nullable();
            $table->string('persembahen')->nullable();
            $table->string('link_page')->nullable();
            $table->string('link_youtube')->nullable();
            $table->integer('sipulung')->nullable();
            $table->integer('jumlah_persembahen')->nullable();
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
        Schema::dropIfExists('ibadah_umum');
    }
}
