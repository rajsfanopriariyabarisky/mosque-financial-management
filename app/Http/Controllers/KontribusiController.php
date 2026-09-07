<?php

namespace App\Http\Controllers;

use App\Models\Kontribusi;
use Illuminate\Http\Request;

class KontribusiController extends Controller
{
    public function index()
    {
        $kontribusis = Kontribusi::all();
        return view('kontribusi.index', compact('kontribusis'));
    }

    public function create()
    {
        return view('kontribusi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        Kontribusi::create($request->all());

        return redirect()->route('kontribusi.index')
            ->with('success', 'Data Kontribusi berhasil ditambahkan.');
    }

    public function edit(Kontribusi $kontribusi)
    {
        return view('kontribusi.edit', compact('kontribusi'));
    }

    public function update(Request $request, Kontribusi $kontribusi)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        $kontribusi->update($request->all());

        return redirect()->route('kontribusi.index')
            ->with('success', 'Data Kontribusi berhasil diperbarui.');
    }

    public function destroy(Kontribusi $kontribusi)
    {
        $kontribusi->delete();

        return redirect()->route('kontribusi.index')
            ->with('success', 'Data Kontribusi berhasil dihapus.');
    }
}
