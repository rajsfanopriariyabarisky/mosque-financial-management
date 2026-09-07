<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajian extends Model
{
    use HasFactory;

    protected $table = 'pengajians';

    protected $fillable = [
        'tanggal',
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
