<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItikafFormsTable extends Migration
{
    public function up()
    {
        Schema::create('itikaf_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id'); 
            $table->string('nama_lengkap');
            $table->integer('umur');
            $table->text('alamat');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar');
            $table->timestamps(); 

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('itikaf_forms');
    }
}