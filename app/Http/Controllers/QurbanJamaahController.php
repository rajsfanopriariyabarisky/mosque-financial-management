<?php

namespace App\Http\Controllers;

use App\Models\QurbanJamaah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Mpdf\Mpdf;

class QurbanJamaahController extends Controller
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
        $qurbanJamaahs = QurbanJamaah::with('user')->latest()->paginate(10);
        return view('qurban_jamaah.index', compact('qurbanJamaahs'));
    }

    public function riwayatUsers()
    {
        $riwayatUsers = QurbanJamaah::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('qurban_jamaah.riwayat_users', compact('riwayatUsers'));
    }

    public function riwayatPembayaran()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth();

        $riwayatPembayaran = QurbanJamaah::with('user')
            ->latest()
            ->paginate(10);

        $totalSemuaQurban = QurbanJamaah::where('status_pembayaran', 'berhasil')->sum('jumlah');

        $totalBulanIni = QurbanJamaah::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah');

        $totalBulanLalu = QurbanJamaah::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $lastMonth->year)
            ->whereMonth('tanggal', $lastMonth->month)
            ->sum('jumlah');

        $totalPerBulan = QurbanJamaah::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $currentYear)
            ->select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('SUM(jumlah) as total'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('qurban_jamaah.riwayat_pembayaran', compact(
            'riwayatPembayaran',
            'totalSemuaQurban',
            'totalBulanIni',
            'totalBulanLalu',
            'totalPerBulan'
        ));
    }

    public function create()
    {
        return view('qurban_jamaah.create');
    }

    public function store(Request $request)
    {
        if ($request->has('qurban_jamaah_id')) {
            $qurbanJamaah = QurbanJamaah::find($request->qurban_jamaah_id);

            if (!$qurbanJamaah) {
                return redirect()->back()->with('error', 'Qurban Jamaah tidak ditemukan.');
            }

            $order_id = 'QURBAN-' . $qurbanJamaah->id . '-' . time();
            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $qurbanJamaah->jumlah,
                ],
                'customer_details' => [
                    'first_name' => $qurbanJamaah->nama_jamaah,
                    'last_name' => '',
                    'email' => $qurbanJamaah->email,
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $qurbanJamaah->update(['token_snap' => $snapToken, 'order_id' => $order_id]);

                return view('qurban_jamaah.pembayaran', compact('snapToken', 'qurbanJamaah'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        } else {
            $request->validate([
                'nama_jamaah' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'jumlah' => 'required',
                'jenis_hewan' => 'required|string',
            ]);

            $request['jumlah'] = str_replace('.', '', $request['jumlah']);
            $jumlah = preg_replace('/[^0-9]/', '', $request->jumlah);

            if (intval($jumlah) < 3500000) {
                return redirect()->back()->withErrors(['jumlah' => 'Jumlah pembayaran qurban minimal Rp 3.500.000'])->withInput();
            }

            $qurbanJamaah = QurbanJamaah::create([
                'user_id' => Auth::id(),
                'tanggal' => now(),
                'nama_jamaah' => $request->nama_jamaah,
                'email' => $request->email,
                'jumlah' => $request->jumlah,
                'jenis_hewan' => $request->jenis_hewan,
            ]);

            $order_id = 'QURBAN-' . $qurbanJamaah->id . '-' . time();
            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $qurbanJamaah->jumlah,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_jamaah,
                    'last_name' => '',
                    'email' => $request->email,
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $qurbanJamaah->update(['token_snap' => $snapToken, 'order_id' => $order_id]);

                return view('qurban_jamaah.pembayaran', compact('snapToken', 'qurbanJamaah'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
    }

    public function show(QurbanJamaah $qurbanJamaah)
    {
        return view('qurban_jamaah.show', compact('qurbanJamaah'));
    }

    public function downloadPdf(QurbanJamaah $qurbanJamaah)
    {
        $mpdf = new Mpdf([
            'orientation' => 'L'
        ]);
        $html = view('qurban_jamaah.pdf', compact('qurbanJamaah'))->render();
        
        $mpdf->WriteHTML($html);
        $filename = 'qurban_jamaah_' . $qurbanJamaah->id . '.pdf';
        
        return $mpdf->Output($filename, 'I');
    }

    public function destroy(QurbanJamaah $qurbanJamaah)
    {
        $qurbanJamaah->delete();
        return redirect()->route('qurban_jamaah.index')->with('success', 'Qurban Jamaah berhasil dihapus.');
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = QurbanJamaah::where('order_id', $request->order_id)->first();
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

    public function verifyPayment(Request $request, QurbanJamaah $qurbanJamaah)
    {
        $request->validate([
            'transaction_status' => 'required|string',
            'order_id' => 'required|string',
        ]);
    
        if ($request->order_id !== $qurbanJamaah->order_id) {
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
                    $qurbanJamaah->update(['status_pembayaran' => 'challenge']);
                } else if ($fraudStatus == 'accept') {
                    $qurbanJamaah->update(['status_pembayaran' => 'berhasil']);
                }
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $qurbanJamaah->update(['status_pembayaran' => 'gagal']);
            } else if ($transactionStatus == 'pending') {
                $qurbanJamaah->update(['status_pembayaran' => 'menunggu']);
            }
    
            return response()->json([
                'success' => true, 
                'message' => 'Status pembayaran berhasil diperbarui',
                'status' => $qurbanJamaah->status_pembayaran,
                'redirect_url' => route('qurban_jamaah.index')  
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memverifikasi pembayaran'], 500);
        }
    }
}