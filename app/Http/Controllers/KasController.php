<?php

namespace App\Http\Controllers;

use App\Models\BukuKas;
use App\Models\Operasional;
use App\Models\Infaq;
use App\Models\Insidental;
use App\Models\Kas;
use App\Models\Kontribusi;
use App\Models\Lainnya;
use App\Models\Parkir;
use App\Models\Pengajian;
use App\Models\Qurban;
use App\Models\Zakat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class KasController extends Controller
{
public function index(Request $request)
{
    // Fungsi generate unique_id dengan suffix counter
    $generateUniqueId = function ($prefix, $tanggal, $counter = 1) {
        $datePart = Carbon::parse($tanggal)->format('Ymd');
        return $prefix . '-' . $datePart . '-' . $counter;
    };

    // Reset sementara (opsional untuk debug agar relasi ulang)
    // Infaq::query()->update(['kas_id' => null]);
    // Operasional::query()->update(['kas_id' => null]);
    // Pengajian::query()->update(['kas_id' => null]);
    // Lainnya::query()->update(['kas_id' => null]);

    $pemasukan = [
        'infaq' => Infaq::all(),
        /*'zakat' => Zakat::all(),
        'qurban' => Qurban::all(),
        'parkir' => Parkir::all(),
        'kontribusi' => Kontribusi::all(),
        'insidental' => Insidental::all(),*/
    ];

    $pengeluaran = [
        'operasional' => Operasional::all(),
        'pengajian' => Pengajian::all(),
        'lainnya' => Lainnya::all(),
    ];

    $validKasIds = [];

    // Pemasukan
    foreach ($pemasukan as $jenis => $data) {
        $counter = 1;
        foreach ($data as $item) {
            $kasValid = $item->kas_id && Kas::where('id', $item->kas_id)->where('jenis', $jenis)->exists();

            if (!$kasValid) {
                do {
                    $uniqueId = $generateUniqueId($jenis, $item->tanggal, $counter++);
                } while (Kas::where('unique_id', $uniqueId)->exists());

                $kas_baru = Kas::create([
                    'unique_id' => $uniqueId,
                    'tanggal' => $item->tanggal,
                    'kategori' => 'pemasukan',
                    'jenis' => $jenis,
                    'keterangan' => $item->keterangan,
                    'jumlah' => $item->jumlah,
                    'saldo_akhir' => 0,
                ]);

                $item->kas_id = $kas_baru->id;
                $item->save();
            }

            $validKasIds[] = $item->kas_id;
        }
    }

    // Pengeluaran
    foreach ($pengeluaran as $jenis => $data) {
        $counter = 1;
        foreach ($data as $item) {
            $kasValid = $item->kas_id && Kas::where('id', $item->kas_id)->where('jenis', $jenis)->exists();

            if (!$kasValid) {
                do {
                    $uniqueId = $generateUniqueId($jenis, $item->tanggal, $counter++);
                } while (Kas::where('unique_id', $uniqueId)->exists());

                $kas_baru = Kas::create([
                    'unique_id' => $uniqueId,
                    'tanggal' => $item->tanggal,
                    'kategori' => 'pengeluaran',
                    'jenis' => $jenis,
                    'keterangan' => $item->keterangan,
                    'jumlah' => $item->jumlah,
                    'saldo_akhir' => 0,
                ]);

                $item->kas_id = $kas_baru->id;
                $item->save();
            }

            $validKasIds[] = $item->kas_id;
        }
    }

    // Hapus kas yang tidak terkait lagi (optional)
    Kas::whereNotIn('id', $validKasIds)->delete();

    // Filtering pencarian
    $search = $request->input('search');
    $kasQuery = Kas::query();

    if ($search) {
        $kasQuery->where(function ($query) use ($search) {
            $query->where('unique_id', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('jenis', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhere('jumlah', 'like', "%{$search}%")
                  ->orWhere('saldo_akhir', 'like', "%{$search}%");
        });
    }

    $kas = $kasQuery->orderBy('tanggal')->paginate(10);

    $saldo_akhir_total = 0;
    $totalpemasukan = 0;
    $totalpengeluaran = 0;

    foreach ($kas as $transaksi) {
        if ($transaksi->kategori == 'pemasukan') {
            $saldo_akhir_total += $transaksi->jumlah;
            $totalpemasukan += $transaksi->jumlah;
        } else {
            $saldo_akhir_total -= $transaksi->jumlah;
            $totalpengeluaran += $transaksi->jumlah;
        }

        $transaksi->saldo_akhir = $saldo_akhir_total;
    }

    $disetujui = Kas::where('disetujui', false)->doesntExist();

    return view('kas.index', compact(
        'kas', 'pemasukan', 'pengeluaran', 'saldo_akhir_total',
        'totalpemasukan', 'totalpengeluaran', 'disetujui', 'search'
    ));
}

    
    

    public function setujui()
    {
        // Menyetujui semua data kas
        Kas::query()->update(['disetujui' => true]);

        return redirect()->route('kas.index')->with('success', 'Semua data kas telah disetujui. PDF sekarang tersedia untuk diunduh.');
    }

    public function tolak()
    {
        // Menolak semua data kas
        Kas::query()->update(['disetujui' => false]);

        return redirect()->route('kas.index')->with('info', 'Semua data kas telah ditolak. PDF tidak tersedia untuk diunduh.');
    }

    public function view_pdf()
    {
        // Memeriksa apakah data kas telah disetujui
        if (!Kas::where('disetujui', false)->doesntExist()) {
            return redirect()->route('kas.index')->with('error', 'PDF tidak tersedia karena data kas belum disetujui.');
        }

        $kas = Kas::orderBy('tanggal')->get();

        // Menginisialisasi saldo awal, total pemasukan, dan total pengeluaran
        $saldo_akhir_total = 0;
        $totalpemasukan = 0;
        $totalpengeluaran = 0;

        // Menghitung saldo akhir, total pemasukan, dan total pengeluaran untuk setiap transaksi
        foreach ($kas as $transaksi) {
            if ($transaksi->kategori == 'pemasukan') {
                $saldo_akhir_total += $transaksi->jumlah;
                $totalpemasukan += $transaksi->jumlah;
            } else {
                $saldo_akhir_total -= $transaksi->jumlah;
                $totalpengeluaran += $transaksi->jumlah;
            }
            $transaksi->saldo_akhir = $saldo_akhir_total;
        }

        // Menggunakan view untuk merender HTML ke dalam PDF
        $html = view('kas.pdf', compact('kas', 'saldo_akhir_total', 'totalpemasukan', 'totalpengeluaran'))->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('kas.pdf', 'I');
    }

    public function create()
    {
        return view('kas.create');
    }

    public function store(Request $request)
    {

        return view('kas.index');
    }


    public function show(Kas $kas)
    {
        return view('kas.show', compact('kas'));
    }

    public function edit(Kas $kas)
    {
        return view('kas.edit', compact('kas'));
    }

    public function update(Request $request, Kas $kas)
    {
        
        return view('kas.index');
    }

    public function destroy(Kas $kas)
    {
        $kas->delete();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil dihapus');
    }

    public function indexHome(Request $request)
    {
        // Mendapatkan awal dan akhir bulan saat ini
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();
    
        // Mengambil data pemasukan dan pengeluaran dari model terkait dalam bulan ini
        $pemasukan = [
            'infaq' => Infaq::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
            'zakat' => Zakat::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
            'qurban' => Qurban::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
            'parkir' => Parkir::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
            'kontribusi' => Kontribusi::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
            'insidental' => Insidental::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
        ];
    
        $pengeluaran = [
            'operasional' => Operasional::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
            'pengajian' => Pengajian::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
            'lainnya' => Lainnya::whereBetween('tanggal', [$awalBulan, $akhirBulan])->get(),
        ];
    
        // Mengambil data kas dalam bulan ini
        $kas = Kas::whereBetween('tanggal', [$awalBulan, $akhirBulan])->orderBy('tanggal')->paginate(10);
    
        // Menghitung ulang saldo akhir
        $saldo_akhir_total = 0;
        $totalpemasukan = 0;
        $totalpengeluaran = 0;
    
        foreach ($kas as $transaksi) {
            if ($transaksi->kategori == 'pemasukan') {
                $saldo_akhir_total += $transaksi->jumlah;
                $totalpemasukan += $transaksi->jumlah;
            } else {
                $saldo_akhir_total -= $transaksi->jumlah;
                $totalpengeluaran += $transaksi->jumlah;
            }
            $transaksi->saldo_akhir = $saldo_akhir_total;
        }
    
        // Mengembalikan tampilan bersama data yang telah diupdate
        return view('kas.indexHome', compact('kas', 'pemasukan', 'pengeluaran', 'saldo_akhir_total', 'totalpemasukan', 'totalpengeluaran'));
    }
    
    public function simpanBukuKas()
    {
        $bulanLalu = Carbon::now()->subMonth()->startOfMonth();
        $awalBulanIni = Carbon::now()->startOfMonth();

        $transaksibulanLalu = Kas::whereBetween('tanggal', [$bulanLalu, $awalBulanIni->subDay()])->orderBy('tanggal')->get();

        if ($transaksibulanLalu->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada transaksi untuk disimpan ke buku kas.');
        }

        $saldoAwal = BukuKas::latest()->value('saldo_akhir') ?? 0;
        $totalPemasukan = $transaksibulanLalu->where('kategori', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksibulanLalu->where('kategori', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $saldoAwal + $totalPemasukan - $totalPengeluaran;

        BukuKas::create([
            'periode' => $bulanLalu,
            'saldo_awal' => $saldoAwal,
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_akhir' => $saldoAkhir,
            'detail_transaksi' => $transaksibulanLalu->toJson(),
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan ke buku kas.');
    }

    public function indexBukuKas(Request $request)
    {
        $bukuKas = BukuKas::orderBy('periode', 'desc')->paginate(10);

        return view('buku_kas.index', compact('bukuKas'));
    }

    public function showBukuKas($id)
    {
        $bukuKas = BukuKas::findOrFail($id);
        $detailTransaksi = json_decode($bukuKas->detail_transaksi, true);

        return view('buku_kas.show', compact('bukuKas', 'detailTransaksi'));
    }
}
