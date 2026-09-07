<?php

namespace App\Http\Controllers;

use App\Models\Insidental;
use Illuminate\Http\Request;

class InsidentalController extends Controller
{
    public function index()
    {
        $insidental = Insidental::all();
        return view('Insidental.index', compact('insidental'));
    }

    public function create()
    {
        return view('insidental.create');
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

        Insidental::create($request->all());

        return redirect()->route('insidental.index')
            ->with('success', 'Insidental created successfully.');
    }

    public function edit($id)
    {
        $insidental = Insidental::find($id);
        return view('insidental.edit', compact('insidental'));
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

        $insidental = Insidental::find($id);
        $insidental->update($request->all());

        return redirect()->route('insidental.index')
            ->with('success', 'Insidental updated successfully');
    }

    public function destroy($id)
    {
        $insidental = Insidental::find($id);
        $insidental->delete();

        return redirect()->route('insidental.index')
            ->with('success', 'Insidental deleted successfully');
    }
}
