<?php
namespace App\Http\Controllers;

use App\Models\Rab;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mpdf\Mpdf;

class RabController extends Controller
{
    public function index()
    {
        $rabs = Rab::all();

        $disetujui = Rab::where('disetujui', false)->doesntExist();

        return view('rabs.index', compact('rabs', 'disetujui'));
    }

    public function setujui()
    {
        // Menyetujui semua data 
        Rab::query()->update(['disetujui' => true]);

        return redirect()->route('rabs.index')->with('success', 'Semua data rancangan anggaran telah disetujui. PDF sekarang tersedia untuk diunduh.');
    }

    public function tolak()
    {
        // Menolak semua data 
        Rab::query()->update(['disetujui' => false]);

        return redirect()->route('rabs.index')->with('info', 'Semua data rancangan anggaran ditolak. PDF tidak tersedia untuk diunduh.');
    }

    public function view_pdf()
    {
        if (!Rab::where('disetujui', false)->doesntExist()) {
            return redirect()->route('rabs.index')->with('error', 'PDF tidak tersedia karena data rancangan anggaran belum disetujui.');
        }

        $rabs = Rab::all();

        // Ubah teks Summernote menjadi HTML biasa
        foreach ($rabs as $rab) {
            $rab->keterangan = html_entity_decode($rab->keterangan);
            $rab->keterangan = strip_tags($rab->keterangan, '<p><b><i><u><img>');
        }
    
        $html = view('rabs.pdf', compact('rabs'))->render();
    
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('rabs.pdf', 'I');
    
    }

    public function create()
    {
        return view('rabs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'periode' => 'required|date',
            'kategori' => 'required|in:pemasukan,pengeluaran',
            'jenis' => 'required',
            'keterangan' => 'nullable',
            'jumlah' => 'required',
        ]);

        $keterangan = $request->keterangan;
        $dom = new DOMDocument();
        $dom->loadHTML($keterangan, 9);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . time() . $key . '.png';
            file_put_contents(public_path() . $image_name, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
        $keterangan = $dom->saveHTML();

        $request['jumlah'] = str_replace('.', '', $request['jumlah']);
        $request['keterangan'] = $keterangan;

        Rab::create($request->all());
        return redirect()->route('rabs.index')->with('success', 'RAB created successfully.');
    }

    public function edit($id)
    {
        $rab = Rab::findOrFail($id);
        return view('rabs.edit', compact('rab'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'periode' => 'required|date',
            'kategori' => 'required|in:pemasukan,pengeluaran',
            'jenis' => 'required',
            'keterangan' => 'nullable',
            'jumlah' => 'required',
        ]);

        $rab = Rab::find($id);
        $keterangan = $request->keterangan;
        $dom = new DOMDocument();
        $dom->loadHTML($keterangan, 9);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            // Check if the image is a new one
            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . time() . $key . '.png';
                file_put_contents(public_path() . $image_name, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }
        $keterangan = $dom->saveHTML();

        $request['jumlah'] = str_replace('.', '', $request['jumlah']);
        $request['keterangan'] = $keterangan;

        $rab->update($request->all());
        return redirect()->route('rabs.index')->with('success', 'RAB updated successfully.');
    }

    public function destroy($id)
    {
        $rab = Rab::find($id);

        $dom = new DOMDocument();
        $dom->loadHTML($rab->keterangan, 9);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $rab->delete();
        return redirect()->route('rabs.index')->with('success', 'RAB deleted successfully.');
    }
}