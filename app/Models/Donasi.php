<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'nama_donatur', 
        'email', 
        'jumlah', 
        'status_pembayaran', 
        'token_snap',
        'order_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
