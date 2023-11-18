<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSiswa implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::select('nisn', 'nis', 'nama', 'id_kelas', 'alamat', 'no_telp')->get();
    }
}
