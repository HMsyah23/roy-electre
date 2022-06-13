<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiCalonPendampingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_calon_pendampings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pendamping');
            $table->unsignedBigInteger('C1')->nullable();
            $table->unsignedBigInteger('C2')->nullable();
            $table->unsignedBigInteger('C3')->nullable();
            $table->unsignedBigInteger('C4')->nullable();
            $table->unsignedBigInteger('C5')->nullable();
        });

        Schema::table('nilai_calon_pendampings', function (Blueprint $table) {
            $table->foreign('id_pendamping')->references('id')->on('calon_pendampings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C1')->references('id')->on('sub_kriterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C2')->references('id')->on('sub_kriterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C3')->references('id')->on('sub_kriterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C4')->references('id')->on('sub_kriterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C5')->references('id')->on('sub_kriterias')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_calon_pendampings');
    }
}
