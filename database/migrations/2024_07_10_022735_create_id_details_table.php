<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('id_detail', function (Blueprint $table) {
            $table->integer('views');
            $table->integer('likes');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_berita');
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_berita')->references('id_berita')->on('berita')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_berita')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('id_detail');
    }
}
