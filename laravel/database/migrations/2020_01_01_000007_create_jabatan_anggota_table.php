<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJabatanAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatan_anggota', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_anggota');
            $table->integer('id_jabatan');
            $table->date('period_start');
            $table->date('period_end');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('jabatan_anggota');
    }
}
