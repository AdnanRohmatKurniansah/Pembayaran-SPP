<?php

namespace App\Imports;

use App\Models\Tagihan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;

class TagihanImport implements ToModel
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
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->all());
        }

        $siswa = \App\Models\Siswa::where('nama', $row[0])->first();

        if (!$siswa) {
            throw new \Exception("Tidak ada siswa yang namanya '{$row[0]}'");
        }

        $spp = \App\Models\Spp::where('tahun', $row[1])->first();

        if (!$spp) {
            throw new \Exception("Tidak ada spp dengan tahun '{$row[1]}'");
        }

        return new Tagihan([
            'id_siswa' => $siswa->id,
            'id_spp' => $spp->id,
        ]);
    }
}
