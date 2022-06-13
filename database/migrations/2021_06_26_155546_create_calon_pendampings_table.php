<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonPendampingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_pendampings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('no_ktp',16);
            $table->string('nama_depan',25);
            $table->string('nama_belakang',50);
            $table->string('no_hp',14);
            $table->date('tanggal_lahir');
            $table->SmallInteger('usia');
            $table->string('email',50);
            $table->string('universitas',100);
            $table->string('jenjang',15);
            $table->string('jenis_kelamin',1);
            $table->text('alamat');
            $table->text('foto');
            $table->text('ktp');
            $table->text('kk');
            $table->text('akta_kelahiran')->nullable();
            $table->text('ijazah')->nullable();
            $table->text('skck')->nullable();
            $table->text('validasi');
            $table->string('tes_tertulis',3);
            $table->string('wawancara',15);
        });

        Schema::table('calon_pendampings', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calon_pendampings');
    }
}
