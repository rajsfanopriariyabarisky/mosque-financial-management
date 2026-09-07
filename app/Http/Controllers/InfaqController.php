<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use Illuminate\Http\Request;

class InfaqController extends Controller
{
    public function index()
    {
        $infaq = Infaq::all();
        return view('infaq.index', compact('infaq'));
    }

    public function create()
    {
        return view('infaq.create');
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

        Infaq::create($request->all());

        return redirect()->route('infaq.index')
            ->with('success', 'Infaq created successfully.');
    }

    public function edit($id)
    {
        $infaq = Infaq::find($id);
        return view('infaq.edit', compact('infaq'));
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

        $infaq = Infaq::find($id);
        $infaq->update($request->all());

        return redirect()->route('infaq.index')
            ->with('success', 'Infaq updated successfully');
    }

    public function destroy($id)
    {
        $infaq = Infaq::find($id);
        $infaq->delete();

        return redirect()->route('infaq.index')
            ->with('success', 'Infaq deleted successfully');
    }
}
