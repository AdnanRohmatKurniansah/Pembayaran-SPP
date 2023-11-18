<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
        $validator = Validator::make($row, [
            '0' => 'required', 
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
            '6' => 'required',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->all());
        }

        $kelas = \App\Models\Kelas::where('nama_kelas', $row[3])->first();

        if (!$kelas) {
            throw new \Exception("Tidak ada kelas dgn nama '{$row[3]}'");
        }

        return new Siswa([
            'nisn' => $row[0],
            'nis' => $row[1],
            'nama' => $row[2],
            'id_kelas' => $kelas->id,
            'alamat' => $row[4],
            'no_telp' => $row[5],
            'password' => bcrypt($row[6]),
        ]);
    }
}
