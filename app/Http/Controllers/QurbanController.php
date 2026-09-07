<?php

namespace App\Http\Controllers;

use App\Models\Qurban;
use Illuminate\Http\Request;

class QurbanController extends Controller
{
    public function index()
    {
        $qurbans = Qurban::all();
        return view('qurban.index', compact('qurbans'));
    }

    public function create()
    {
        return view('qurban.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelompok' => 'required|string',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        Qurban::create($request->all());

        return redirect()->route('qurban.index')
            ->with('success', 'Data Qurban berhasil ditambahkan.');
    }

    public function edit(Qurban $qurban)
    {
        return view('qurban.edit', compact('qurban'));
    }

    public function update(Request $request, Qurban $qurban)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelompok' => 'required|string',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        $qurban->update($request->all());

        return redirect()->route('qurban.index')
            ->with('success', 'Data Qurban berhasil diperbarui.');
    }

    public function destroy(Qurban $qurban)
    {
        $qurban->delete();

        return redirect()->route('qurban.index')
            ->with('success', 'Data Qurban berhasil dihapus.');
    }
}
