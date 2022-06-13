<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode',6);
            $table->unsignedBigInteger('id_kriteria');
            $table->string('kondisi',30);
            $table->string('nilai',3);
        });

        Schema::table('sub_kriterias', function (Blueprint $table) {
            $table->foreign('id_kriteria')->references('id')->on('kriterias')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_kriterias');
    }
}
