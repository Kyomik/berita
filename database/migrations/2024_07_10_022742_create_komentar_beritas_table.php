<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarBeritasTable extends Migration
{
    public function up()
    {
        Schema::create('komentar_berita', function (Blueprint $table) {
            $table->id('id_komentar');
            $table->unsignedBigInteger('id_berita');
            $table->unsignedBigInteger('id_user');
            $table->text('isi_komentar');
            $table->dateTime('tanggal_komentar');
            $table->foreign('id_berita')->references('id_berita')->on('berita')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('komentar_berita');
    }
}
