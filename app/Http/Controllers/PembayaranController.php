<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pembayaran.index', [
            'pembayarans' => Pembayaran::orderBy('id','desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pembayaran.create', [
            'tagihans' => Tagihan::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_tagihan' => 'required|integer',
            'jumlah_bayar' => 'required|integer'
        ]);

        $tagihan = Tagihan::where('id', $data['id_tagihan'])->first();

        $data['id_petugas'] = Auth::guard('petugas')->user()->id;
        $data['jumlah_kurang'] = $tagihan->spp->nominal - $data['jumlah_bayar'];

        if ($data['jumlah_kurang'] == 0) {
            $tagihan->update([
                'status' => 'lunas'
            ]);
        }

        Pembayaran::create($data);

        return redirect('/dashboard/pembayaran')->with('success', 'Pembayaran berhasil dilakukan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        return view('dashboard.pembayaran.edit', [
            'pembayaran' => $pembayaran,
            'tagihans' => Tagihan::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $data = $request->validate([
            'id_tagihan' => 'required|integer',
            'jumlah_bayar' => 'required|integer'
        ]);

        $tagihan = Tagihan::where('id', $data['id_tagihan'])->first();

        $data['id_petugas'] = Auth::guard('petugas')->user()->id;
        $data['jumlah_kurang'] = $tagihan->spp->nominal - $data['jumlah_bayar'];
        
        if ($data['jumlah_bayar'] == $tagihan->spp->nominal) {
            $tagihan->update([
                'status' => 'lunas'
            ]);
        }

        $pembayaran->update($data);

        return redirect('/dashboard/pembayaran')->with('success', 'Pembayaran diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }

    public function generateLaporan(Request $request) {
        $dari = $request->dari;
        $sampai = $request->sampai;
    
        $data = Pembayaran::whereBetween('updated_at', [$dari, $sampai])
            ->get();
    
        if ($data->count() < 1) {
            return back()->with('error', 'Tidak ada pembayaran dlm rentang waktu itu.');
        }
    
        $pdf = Pdf::loadView('dashboard.laporan', [
            'data' => $data
        ])->setOptions(['defaultFont' => 'sans-serif']);
    
        // Use the stream method to display the PDF
        return $pdf->stream('laporan.pdf');
    }
    
}
