<?php

namespace App\Http\Controllers;

use App\Imports\TagihanImport;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.tagihan.index', [
            'tagihans' => Tagihan::orderBy('id','desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.tagihan.create', [
            'spps' => Spp::orderBy('id','desc')->get(),
            'siswas' => Siswa::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_siswa' => 'required|integer',
            'id_spp' => 'required|integer'
        ]);

        Tagihan::create($data);

        return redirect('/dashboard/tagihan')->with('success', 'Data tagihan baru ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        return view('dashboard.tagihan.edit', [
            'tagihan' => $tagihan,
            'spps' => Spp::orderBy('id','desc')->get(),
            'siswas' => Siswa::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        $data = $request->validate([
            'id_siswa' => 'required|integer',
            'id_spp' => 'required|integer'
        ]);

        $tagihan->update($data);

        return redirect('/dashboard/tagihan')->with('success', 'Data tagihan dupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();

        return back()->with('success', 'Data tagihan berhasil dihapus');
    }
    public function importTagihan(Request $request){
        try {
            Excel::import(new TagihanImport, $request->file('file')->store('files'));
            
            return redirect()->back()->with('success', 'Berhasil mengimport');
        } catch (ValidationException $validationException) {
            $errors = $validationException->validator->errors()->all();
            return redirect()->back()->with('error', $errors);
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
}
