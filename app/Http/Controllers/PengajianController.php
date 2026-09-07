<?php

namespace App\Http\Controllers;

use App\Models\Pengajian;
use Illuminate\Http\Request;

class PengajianController extends Controller
{
    public function index()
    {
        $pengajian = Pengajian::all();
        return view('pengajian.index', compact('pengajian'));
    }

    public function create()
    {
        return view('pengajian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        Pengajian::create($request->all());

        return redirect()->route('pengajian.index')
            ->with('success', 'pengajian created successfully.');
    }

    public function edit($id)
    {
        $pengajian = Pengajian::find($id);
        return view('pengajian.edit', compact('pengajian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'jumlah' => 'required',
            'komentar' => 'nullable',
        ]);

        $request['jumlah'] = str_replace('.','', $request['jumlah']);

        $pengajian = Pengajian::find($id);
        $pengajian->update($request->all());

        return redirect()->route('pengajian.index')
            ->with('success', 'pengajian updated successfully');
    }

    public function destroy($id)
    {
        $pengajian = Pengajian::find($id);
        $pengajian->delete();

        return redirect()->route('pengajian.index')
            ->with('success', 'pengajian deleted successfully');
    }
}
