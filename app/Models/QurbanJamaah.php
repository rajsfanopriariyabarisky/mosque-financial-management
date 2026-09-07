<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QurbanJamaah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'nama_jamaah',
        'email',
        'jumlah',
        'jenis_hewan',
        'status_pembayaran',
        'token_snap',
        'order_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}