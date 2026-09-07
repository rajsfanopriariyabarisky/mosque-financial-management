<?php

namespace App\Http\Controllers;

use App\Models\Lainnya;
use Illuminate\Http\Request;

class LainnyaController extends Controller
{
    public function index()
    {
        $lainnya = Lainnya::all();
        return view('lainnya.index', compact('lainnya'));
    }

    public function create()
    {
        return view('lainnya.create');
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

        Lainnya::create($request->all());

        return redirect()->route('lainnya.index')
            ->with('success', 'lainnya created successfully.');
    }

    public function edit($id)
    {
        $lainnya = Lainnya::find($id);
        return view('lainnya.edit', compact('lainnya'));
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

        $lainnya = Lainnya::find($id);
        $lainnya->update($request->all());

        return redirect()->route('lainnya.index')
            ->with('success', 'lainnya updated successfully');
    }

    public function destroy($id)
    {
        $lainnya = Lainnya::find($id);
        $lainnya->delete();

        return redirect()->route('lainnya.index')
            ->with('success', 'lainnya deleted successfully');
    }
}
