<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQurbanJamaahsTable extends Migration
{
    public function up()
    {
        Schema::create('qurban_jamaahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('tanggal');
            $table->string('nama_jamaah');
            $table->string('email');
            $table->bigInteger('jumlah');
            $table->string('jenis_hewan');
            $table->string('status_pembayaran')->default('menunggu');
            $table->string('token_snap')->nullable();
            $table->string('order_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qurban_jamaahs');
    }
}