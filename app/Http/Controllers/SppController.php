<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.spp.index', [
            'spps' => Spp::orderBy('id','desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.spp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun' => 'required|integer',
            'nominal' => 'required|integer'
        ]);

        Spp::create($data);

        return redirect('/dashboard/spp')->with('success', 'Data spp baru ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spp $spp)
    {
        return view('dashboard.spp.edit', [
            'spp' => $spp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spp $spp)
    {
        $data = $request->validate([
            'tahun' => 'required|integer',
            'nominal' => 'required|integer'
        ]);

        $spp->update($data);

        return redirect('/dashboard/spp')->with('info', 'Data spp diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spp $spp)
    {
        $spp->delete();

        return back()->with('success', 'Data spp berhasil dihapus');
    }
}
