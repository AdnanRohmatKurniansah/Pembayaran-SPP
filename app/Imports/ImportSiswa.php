<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSiswa implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'nisn' => $row[0],
            'nis' => $row[1],
            'nama' => $row[2],
            'id_kelas' => $row[3],
            'alamat' => $row[4],
            'no_telp' => $row[5],
            'password' => bcrypt($row[6]),
        ]);
    }
}
