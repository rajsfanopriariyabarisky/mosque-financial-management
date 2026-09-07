<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Mpdf\Mpdf;

class DonasiController extends Controller
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
        $donasi = Donasi::with('user')->latest()->paginate(10);
        return view('donasi.index', compact('donasi'));
    }

    public function riwayatUsers()
    {
        $riwayatUsers = Donasi::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('donasi.riwayat_users', compact('riwayatUsers'));
    }

    public function riwayatPembayaran()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth();

        $riwayatPembayaran = Donasi::with('user')
            ->latest()
            ->paginate(10);

        $totalSemuaDonasi = Donasi::where('status_pembayaran', 'berhasil')->sum('jumlah');

        $totalBulanIni = Donasi::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah');

        $totalBulanLalu = Donasi::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $lastMonth->year)
            ->whereMonth('tanggal', $lastMonth->month)
            ->sum('jumlah');

        // Hitung total per bulan untuk tahun ini
        $totalPerBulan = Donasi::where('status_pembayaran', 'berhasil')
            ->whereYear('tanggal', $currentYear)
            ->select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('SUM(jumlah) as total'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('donasi.riwayat_donasi', compact(
            'riwayatPembayaran',
            'totalSemuaDonasi',
            'totalBulanIni',
            'totalBulanLalu',
            'totalPerBulan'
        ));
    }

    public function create()
    {
        return view('donasi.create');
    }

    public function store(Request $request)
    {
        if ($request->has('donasi_id')) {
            // Logika untuk melanjutkan pembayaran donasi yang sudah ada
            $donasi = Donasi::find($request->donasi_id);

            if (!$donasi) {
                return redirect()->back()->with('error', 'Donasi tidak ditemukan.');
            }

            $order_id = 'DONASI-' . $donasi->id . '-' . time();
            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $donasi->jumlah,
                ],
                'customer_details' => [
                    'first_name' => $donasi->nama_donatur,
                    'last_name' => '',
                    'email' => $donasi->email,
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $donasi->update(['token_snap' => $snapToken, 'order_id' => $order_id]);

                return view('donasi.pembayaran', compact('snapToken', 'donasi'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        } else {
            // Logika untuk membuat donasi baru
            $request->validate([
                'nama_donatur' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'jumlah' => 'required',
            ]);

            $request['jumlah'] = str_replace('.', '', $request['jumlah']);
            $jumlah = preg_replace('/[^0-9]/', '', $request->jumlah);

            if (intval($jumlah) < 1000) {
                return redirect()->back()->withErrors(['jumlah' => 'Jumlah donasi minimal Rp 1.000'])->withInput();
            }

            $donasi = Donasi::create([
                'user_id' => Auth::id(),
                'tanggal' => now(),
                'nama_donatur' => $request->nama_donatur,
                'email' => $request->email,
                'jumlah' => $request->jumlah,
            ]);

            $order_id = 'DONASI-' . $donasi->id . '-' . time();
            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $donasi->jumlah,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_donatur,
                    'last_name' => '',
                    'email' => $request->email,
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $donasi->update(['token_snap' => $snapToken, 'order_id' => $order_id]);

                return view('donasi.pembayaran', compact('snapToken', 'donasi'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
    }


    public function show(Donasi $donasi)
    {
        return view('donasi.show', compact('donasi'));
    }

    public function downloadPdf(Donasi $donasi)
    {
        $mpdf = new Mpdf([
            'orientation' => 'L'  // 'L' for landscape, 'P' for portrait (default)
        ]);
        $html = view('donasi.pdf', compact('donasi'))->render();

        $mpdf->WriteHTML($html);
        $filename = 'donasi_' . $donasi->id . '.pdf';

        return $mpdf->Output($filename, 'I');
    }

    public function destroy(Donasi $donasi)
    {
        $donasi->delete();
        return redirect()->route('donasi.index')->with('success', 'Donasi berhasil dihapus.');
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Donasi::where('order_id', $request->order_id)->first();
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

    public function verifyPayment(Request $request, Donasi $donasi)
    {
        $request->validate([
            'transaction_status' => 'required|string',
            'order_id' => 'required|string',
        ]);

        if ($request->order_id !== $donasi->order_id) {
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
                    $donasi->update(['status_pembayaran' => 'challenge']);
                } else if ($fraudStatus == 'accept') {
                    $donasi->update(['status_pembayaran' => 'berhasil']);
                }
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $donasi->update(['status_pembayaran' => 'gagal']);
            } else if ($transactionStatus == 'pending') {
                $donasi->update(['status_pembayaran' => 'menunggu']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran berhasil diperbarui',
                'status' => $donasi->status_pembayaran,
                'redirect_url' => route('donasi.index')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memverifikasi pembayaran'], 500);
        }
    }

}
