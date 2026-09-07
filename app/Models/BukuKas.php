<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKas extends Model
{
    use HasFactory;

    protected $table = 'buku_kas';

    protected $fillable = [
        'periode',
        'saldo_awal',
        'total_pemasukan',
        'total_pengeluaran',
        'saldo_akhir',
        'detail_transaksi',
        'disetujui',
    ];

    protected $casts = [
        'periode' => 'date',
        'saldo_awal' => 'integer',
        'total_pemasukan' => 'integer',
        'total_pengeluaran' => 'integer',
        'saldo_akhir' => 'integer',
        'detail_transaksi' => 'array',
        'disetujui' => 'boolean',
    ];

    // Jika Anda ingin menambahkan relasi ke model Kas
    public function kas()
    {
        return $this->hasMany(Kas::class, 'periode', 'periode');
    }

    // Method untuk mendapatkan total saldo
    public function getTotalSaldoAttribute()
    {
        return $this->saldo_awal + $this->total_pemasukan - $this->total_pengeluaran;
    }

    // Method untuk mengecek apakah buku kas sudah disetujui
    public function isApproved()
    {
        return $this->disetujui;
    }
}