<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use Illuminate\Http\Request;

class ZakatController extends Controller
{
    public function index()
    {
        $zakats = Zakat::all();
        return view('zakat.index', compact('zakats'));
    }

    public function create()
    {
        return view('zakat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:zakat_fitrah,zakat_maal',
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        Zakat::create($request->all());

        return redirect()->route('zakat.index')
            ->with('success', 'Zakat created successfully.');
    }

    public function edit(Zakat $zakat)
    {
        return view('zakat.edit', compact('zakat'));
    }

    public function update(Request $request, Zakat $zakat)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:zakat_fitrah,zakat_maal',
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        $zakat->update($request->all());

        return redirect()->route('zakat.index')
            ->with('success', 'Zakat updated successfully');
    }

    public function destroy(Zakat $zakat)
    {
        $zakat->delete();

        return redirect()->route('zakat.index')
            ->with('success', 'Zakat deleted successfully');
    }
}
