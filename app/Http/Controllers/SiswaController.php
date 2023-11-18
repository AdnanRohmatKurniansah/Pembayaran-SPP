<?php

namespace App\Http\Controllers;

use App\Exports\ExportSiswa;
use App\Imports\ImportSiswa;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.siswa.index', [
            'siswas' => Siswa::orderBy('id','desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.siswa.create', [
            'kelases' => Kelas::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nisn' => 'required|unique:siswas|max:10',
            'nis' => 'required|unique:siswas|max:10',
            'nama' => 'required|max:35',
            'id_kelas' => 'required',
            'alamat' =>  'required',
            'no_telp' =>  'required|max:13',
            'password' => 'required|max:255'
        ]);

        $data['password'] = Hash::make($data['password']);

        Siswa::create($data);

        return redirect('/dashboard/siswa')->with('success', 'Siswa baru ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('dashboard.siswa.edit', [
            'siswa' => $siswa,
            'kelases' => Kelas::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nisn' => 'required|max:10',
            'nis' => 'required|max:10',
            'nama' => 'required|max:35',
            'id_kelas' => 'required',
            'alamat' =>  'required',
            'no_telp' =>  'required|max:13',
            'password' => 'required|max:255'
        ]);

        $data['password'] = Hash::make($data['password']);

        $siswa->update($data);

        return redirect('/dashboard/siswa')->with('info', 'Siswa diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return back()->with('success', 'Siswa berhasil dihapus');
    }

    public function importSiswa(Request $request){
        try {
            Excel::import(new ImportSiswa, $request->file('file')->store('files'));
            
            return redirect()->back()->with('success', 'Berhasil mengimport');
        } catch (ValidationException $validationException) {
            $errors = $validationException->validator->errors()->all();
            return redirect()->back()->with('error', $errors);
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    public function exportSiswa(){
        return Excel::download(new ExportSiswa, 'siswa.xlsx');
    }
}
