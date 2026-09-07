<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Storage;
use Mckenziearts\Notify\LaravelNotify;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboards = Dashboard::all();
        return view('dashboards.index', compact('dashboards'));
    }

    public function indexHome()
    {
        $indexHome = Dashboard::all();
        return view('dashboards.indexHome', compact('indexHome'));
    }

    public function create()
    {
        $dashboard = Dashboard::first();
        if ($dashboard) {
            return redirect()->route('dashboard.edit', $dashboard->id);
        }
        return view('dashboards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dashboard = Dashboard::first();
        if ($dashboard) {
            return redirect()->route('dashboard.edit', $dashboard->id);
        }

        $dashboard = new Dashboard();
        $dashboard->title = $request->title;
        $dashboard->content = $request->content;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $dashboard->image = $imageName;
        }

        $dashboard->save();

        return redirect()->route('dashboard.index')
                         ->with('success', 'Dashboard item created successfully.');
    }

    public function show($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        return view('dashboards.show', compact('dashboard'));
    }

    public function edit($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        return view('dashboards.edit', compact('dashboard'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dashboard = Dashboard::findOrFail($id);
        
        // Delete old image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image file
            if ($dashboard->image) {
                Storage::delete('public/images/' . $dashboard->image);
            }

            // Upload new image file
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $dashboard->image = $imageName;
        }

        $dashboard->title = $request->title;
        $dashboard->content = $request->content;

        $dashboard->save();

        return redirect()->route('dashboard.index')
                         ->with('success', 'Dashboard item updated successfully.');
    }

    public function destroy($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        if ($dashboard->image) {
            Storage::delete('public/images/' . $dashboard->image);
        }
        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Dashboard item deleted successfully.');
    }
}
