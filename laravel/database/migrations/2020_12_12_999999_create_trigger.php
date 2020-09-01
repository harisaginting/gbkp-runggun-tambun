<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared("
            CREATE TRIGGER `uuid` BEFORE INSERT ON `anggota`
             FOR EACH ROW BEGIN 
            IF new.uuid IS NULL THEN
                SET new.uuid = uuid();
              END IF;
            END
        ");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::unprepared('DROP TRIGGER `uuid`');
    }
}
