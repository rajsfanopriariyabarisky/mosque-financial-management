<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatJamaah extends Model
{
    use HasFactory;

    protected $table = 'zakat_jamaahs';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jenis',
        'sub_jenis',
        'nama',
        'alamat',
        'keterangan',
        'nilai_aset',
        'jumlah',
        'token_snap',
        'order_id',
        'status_pembayaran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
