<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    use HasFactory;

    protected $table = 'parkirs';

    protected $fillable = [
        'tanggal',
        'nomor_kendaraan',
        'jenis_kendaraan',
        'nama',
        'keterangan',
        'jumlah',
        'kas_id',
        'komentar'
    ];

    public function kas()
    {
        return $this->belongsTo(Kas::class);
    }
}
