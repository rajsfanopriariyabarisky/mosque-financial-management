<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;

    protected $table = 'kas';

    protected $fillable = [
        'unique_id',
        'tanggal',
        'kategori',
        'jenis',
        'keterangan',
        'jumlah',
        'saldo_akhir',
        'disetujui'
    ];

    public function infaqs()
    {
        return $this->hasMany(Infaq::class);
    }

    public function zakats()
    {
        return $this->hasMany(Zakat::class);
    }

    public function qurbans()
    {
        return $this->hasMany(Qurban::class);
    }

    public function parkirs()
    {
        return $this->hasMany(Parkir::class);
    }

    public function kontribusis()
    {
        return $this->hasMany(Kontribusi::class);
    }

    public function insidentals()
    {
        return $this->hasMany(Insidental::class);
    }

    public function operasionals()
    {
        return $this->hasMany(Operasional::class);
    }

    public function pengajians()
    {
        return $this->hasMany(Pengajian::class);
    }

    public function lainnyas()
    {
        return $this->hasMany(Lainnya::class);
    }
}
