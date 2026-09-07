<?php

namespace App\Http\Controllers;

use App\Models\ZakatJamaah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Mpdf\Mpdf;

class ZakatJamaahController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $zakatJamaahs = ZakatJamaah::with('user')->latest()->paginate(10);
        return view('zakat_jamaah.index', compact('zakatJamaahs'));
    }

    public function riwayatUsers()
    {
        $riwayatUsers = ZakatJamaah::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('zakat_jamaah.riwayat_users', compact('riwayatUsers'));
    }

    public function riwayatPembayaran()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth();

        $riwayatPembayaran = ZakatJamaah::with('user')
            ->latest()
            ->paginate(10);

        $totalSemuaZakat = ZakatJamaah::where('status_pembayaran', 'berhasil')->sum('jumlah');

        $totalBulanIni = ZakatJamaah::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah');

        $totalBulanLalu = ZakatJamaah::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $lastMonth->year)
            ->whereMonth('tanggal', $lastMonth->month)
            ->sum('jumlah');

        $totalPerBulan = ZakatJamaah::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $currentYear)
            ->select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('SUM(jumlah) as total'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('zakat_jamaah.riwayat_pembayaran', compact(
            'riwayatPembayaran',
            'totalSemuaZakat',
            'totalBulanIni',
            'totalBulanLalu',
            'totalPerBulan'
        ));
    }

    public function create()
    {
        return view('zakat_jamaah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:zakat_fitrah,zakat_maal',
            'sub_jenis' => 'nullable|in:emas,perak,penghasilan',
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'nilai_aset' => 'nullable',
            'jumlah' => 'required',
        ]);

        $request['jumlah'] = str_replace('.', '', $request['jumlah']);
        $request['nilai_aset'] = str_replace('.', '', $request['nilai_aset']);

        if ($request->jenis == 'zakat_maal') {
            $request['jumlah'] = $this->calculateZakatMaal($request->sub_jenis, $request->nilai_aset);
        }

        $zakatJamaah = ZakatJamaah::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'sub_jenis' => $request->sub_jenis,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'nilai_aset' => $request->nilai_aset,
            'jumlah' => $request->jumlah,
        ]);

        $order_id = 'ZAKAT-' . $zakatJamaah->id . '-' . time();
        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $zakatJamaah->jumlah,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'last_name' => '',
                'email' => Auth::user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $zakatJamaah->update(['token_snap' => $snapToken, 'order_id' => $order_id]);

            return view('zakat_jamaah.pembayaran', compact('snapToken', 'zakatJamaah'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function calculateZakatMaal($sub_jenis, $nilai_aset)
    {
        switch ($sub_jenis) {
            case 'emas':
                return $nilai_aset >= 82312725 ? $nilai_aset * 0.025 : 0;
            case 'perak':
                return $nilai_aset >= 6545000 ? $nilai_aset * 0.025 : 0;
            case 'penghasilan':
                return $nilai_aset >= 6859394 ? $nilai_aset * 0.025 : 0;
            default:
                return 0;
        }
    }

    public function show(ZakatJamaah $zakatJamaah)
    {
        return view('zakat_jamaah.show', compact('zakatJamaah'));
    }

    public function downloadPdf(ZakatJamaah $zakatJamaah)
    {
        $mpdf = new Mpdf([
            'orientation' => 'L'
        ]);
        $html = view('zakat_jamaah.pdf', compact('zakatJamaah'))->render();
        
        $mpdf->WriteHTML($html);
        $filename = 'zakat_' . $zakatJamaah->id . '.pdf';
        
        return $mpdf->Output($filename, 'I');
    }

    public function destroy(ZakatJamaah $zakatJamaah)
    {
        $zakatJamaah->delete();
        return redirect()->route('zakat_jamaah.index')->with('success', 'Data zakat berhasil dihapus.');
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = ZakatJamaah::where('order_id', $request->order_id)->first();
            if ($order) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $order->update(['status_pembayaran' => 'berhasil']);
                } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                    $order->update(['status_pembayaran' => 'gagal']);
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function verifyPayment(Request $request, ZakatJamaah $zakatJamaah)
    {
        $request->validate([
            'transaction_status' => 'required|string',
            'order_id' => 'required|string',
        ]);
    
        if ($request->order_id !== $zakatJamaah->order_id) {
            return response()->json(['success' => false, 'message' => 'Order ID tidak sesuai'], 400);
        }
    
        try {
            $statusResponse = Transaction::status($request->order_id);
            
            if (!is_object($statusResponse)) {
                throw new \Exception('Invalid response from Midtrans');
            }
    
            $transactionStatus = $statusResponse->transaction_status;
            $fraudStatus = $statusResponse->fraud_status;
    
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                if ($fraudStatus == 'challenge') {
                    $zakatJamaah->update(['status_pembayaran' => 'challenge']);
                } else if ($fraudStatus == 'accept') {
                    $zakatJamaah->update(['status_pembayaran' => 'berhasil']);
                }
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $zakatJamaah->update(['status_pembayaran' => 'gagal']);
            } else if ($transactionStatus == 'pending') {
                $zakatJamaah->update(['status_pembayaran' => 'menunggu']);
            }
    
            return response()->json([
                'success' => true, 
                'message' => 'Status pembayaran berhasil diperbarui',
                'status' => $zakatJamaah->status_pembayaran,
                'redirect_url' => route('zakat_jamaah.index')  
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memverifikasi pembayaran'], 500);
        }
    }
}