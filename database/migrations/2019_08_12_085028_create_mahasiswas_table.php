<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nrp')->unique();
            $table->string('nama');
            $table->string('departemen');
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin');
            $table->string('alamat_asal')->nullable();
            $table->string('alamat_surabaya')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->string('status');
            $table->string('jalur')->nullable();

            $table->string('pkk_id')->nullable();
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
        Schema::dropIfExists('mahasiswas');
    }
}
