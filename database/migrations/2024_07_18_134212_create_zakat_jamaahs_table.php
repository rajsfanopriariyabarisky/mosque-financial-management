<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        {
            Schema::create('zakat_jamaahs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained();
                $table->date('tanggal');
                $table->enum('jenis', ['zakat_fitrah', 'zakat_maal']);
                $table->enum('sub_jenis', ['emas', 'perak', 'penghasilan'])->nullable();
                $table->string('nama');
                $table->string('alamat')->nullable();
                $table->text('keterangan')->nullable();
                $table->biginteger('nilai_aset')->nullable();
                $table->biginteger('jumlah');
                $table->string('token_snap')->nullable();
                $table->string('order_id')->nullable();
                $table->string('status_pembayaran')->default('menunggu');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakat_jamaahs');
    }
};
