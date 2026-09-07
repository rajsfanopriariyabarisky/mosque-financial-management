<?php

namespace App\Http\Controllers;

use App\Models\Operasional;
use Illuminate\Http\Request;

class OperasionalController extends Controller
{
    public function index()
    {
        $operasional = Operasional::all();
        return view('operasional.index', compact('operasional'));
    }

    public function create()
    {
        return view('operasional.create');
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

        Operasional::create($request->all());

        return redirect()->route('operasional.index')
            ->with('success', 'operasional created successfully.');
    }

    public function edit($id)
    {
        $operasional = Operasional::find($id);
        return view('operasional.edit', compact('operasional'));
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

        $operasional = Operasional::find($id);
        $operasional->update($request->all());

        return redirect()->route('operasional.index')
            ->with('success', 'operasional updated successfully');
    }

    public function destroy($id)
    {
        $operasional = Operasional::find($id);
        $operasional->delete();

        return redirect()->route('operasional.index')
            ->with('success', 'operasional deleted successfully');
    }
}
