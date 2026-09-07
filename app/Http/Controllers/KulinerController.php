<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuliner;


class KulinerController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Kuliner::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->has('filter')) {
            if ($request->filter == 'popular') {
                $query->orderBy('rating', 'desc');
            } elseif ($request->filter == 'recent') {
                $query->orderBy('created_at', 'desc');
            }
        }

        $kuliners = $query->paginate(9);

        return view('kuliner.index', compact('kuliners'));
    }

    public function show($id)
    {
        $kuliner = Kuliner::findOrFail($id);


        // Kirim semua ke view
        return view('kuliner.detail', compact('kuliner'));
    }

}
