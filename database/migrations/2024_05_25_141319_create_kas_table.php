<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 30)->unique()->nullable();
            $table->date('tanggal');
            $table->enum('kategori', ['pemasukan', 'pengeluaran']);
            $table->string('jenis');
            $table->text('keterangan')->nullable();
            $table->bigInteger('jumlah');
            $table->bigInteger('saldo_akhir');
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
        Schema::dropIfExists('kas');
    }
}
