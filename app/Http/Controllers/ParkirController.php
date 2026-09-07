<?php
namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;

class ParkirController extends Controller
{
    public function index()
    {
        $parkirs = Parkir::all();
        return view('parkir.index', compact('parkirs'));
    }

    public function create()
    {
        return view('parkir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nomor_kendaraan' => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'nama' => 'required|string',
            'keterangan' => 'nullable',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        Parkir::create($request->all());

        return redirect()->route('parkir.index')
            ->with('success', 'Data Parkir berhasil ditambahkan.');
    }

    public function edit(Parkir $parkir)
    {
        return view('parkir.edit', compact('parkir'));
    }

    public function update(Request $request, Parkir $parkir)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nomor_kendaraan' => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'nama' => 'required|string',
            'keterangan' => 'nullable',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        $parkir->update($request->all());

        return redirect()->route('parkir.index')
            ->with('success', 'Data Parkir berhasil diperbarui.');
    }

    public function destroy(Parkir $parkir)
    {
        $parkir->delete();

        return redirect()->route('parkir.index')
            ->with('success', 'Data Parkir berhasil dihapus.');
    }
}
