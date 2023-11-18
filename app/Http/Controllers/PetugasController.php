<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInPetugasId = Auth::id();

        return view('dashboard.petugas.index', [
            'petugases' => Petugas::where('level', 'petugas')->where('id', '!=', $loggedInPetugasId)
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_petugas' => 'required|max:25',
            'username' => 'required|max:25',
            'level' => 'required',
            'password' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);

        Petugas::create($data);

        return redirect('/dashboard/petugas')->with('success', 'Petugas baru ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Petugas $petuga)
    {
        return view('dashboard.petugas.edit', [
            'petugas' => $petuga
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Petugas $petuga)
    {
        $data = $request->validate([
            'nama_petugas' => 'required|max:25',
            'username' => 'required|max:25',
            'level' => 'required',
            'password' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);

        $petuga->update($data);

        return redirect('/dashboard/petugas')->with('info', 'Petugas diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Petugas $petuga)
    {
        $petuga->delete();

        return back()->with('success', 'Petugas berhasil dihapus');
    }
}
