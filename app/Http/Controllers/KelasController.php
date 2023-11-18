<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.siswa.kelas.index', [
            'kelases' => Kelas::orderBy('id','desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.siswa.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kelas' => 'required|max:10',
            'kompetensi_keahlian' => 'required|max:50'
        ]);

        Kelas::create($data);

        return redirect('/dashboard/siswa/kelas')->with('success', 'Kelas baru ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        return view('dashboard.siswa.kelas.edit', [
            'kelas' => $kela
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $data = $request->validate([
            'nama_kelas' => 'required|max:10',
            'kompetensi_keahlian' => 'required|max:50'
        ]);

        $kela->update($data);

        return redirect('/dashboard/siswa/kelas')->with('info', 'Kelas diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return back()->with('success', 'Kelas berhasil dihapus');
    }
}
