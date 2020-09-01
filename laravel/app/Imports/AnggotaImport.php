<?php

namespace App\Imports;

use App\Models\Anggota;
use Harisa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue; //IMPORT SHOUDLQUEUE
use Maatwebsite\Excel\Concerns\WithChunkReading; //IMPORT CHUNK READING

class AnggotaImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        // echo json_encode(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(strtotime('10-10-2002')));die;
        // MODIFIKASI ARRAY NYA DENGAN MENAMBAHKAN KEY

        $sektor     = Harisa::getConfigByName($row["sektor"]);
        $marga      = Harisa::getConfigByName($row["marga"]);
        $pekerjaan  = Harisa::getConfigByName($row["pekerjaan"]);
        $pendidikan = Harisa::getConfigByName($row["pendidikan"]);

        $birthday   = explode("/", $row['tanggal_lahir']);
        if(empty($birthday[0]) || empty($birthday[1]) || empty($birthday[2])){
            $birthdayFormatted = null;
        }else{
            $birthdayFormatted = $birthday[2]."/".$birthday[0]."/".$birthday[1];
        }

        // echo $marga;die;
        return new Anggota([    
            'nama'              => $row['nama'],
            'nama_depan'        => $row['nama_depan'],
            'nama_belakang'     => $row['nama_belakang'],
            'marga'             => !empty($marga) ? $marga : $row['marga'],
            'email'             => $row['email'],
            'tempat_lahir'      => $row['tempat_lahir'],
            'tanggal_lahir'     => $birthdayFormatted,
            'jenis_kelamin'     => $row['jenis_kelamin'],
            'telepon'           => $row['telepon'],
            'alamat'            => $row['alamat'],
            'domisili_provinsi' => $row['domisili_provinsi'],
            'domisili_kota'     => $row['domisili_kota'],
            'domisili_kecamatan'=> $row['domisili_kecamatan'],
            'sektor'            => !empty($sektor) ? $sektor : $row['sektor'],
            'pekerjaan'         => !empty($pekerjaan) ? $pekerjaan : $row['pekerjaan'],
            'pendidikan'        => !empty($pendidikan) ? $pendidikan :  $row['pendidikan'],
            'jurusan'           => $row['jurusan'],
            'sekolah'           => $row['sekolah'],
            'perusahaan'        => $row['perusahaan'],
            'hobi'              => $row['hobi'],
            'tahun_ngawan'      => $row['tahun_ngawan'],
            'runggun_ngawan'    => $row['runggun_ngawan'],
            'instagram'         => $row['instagram'],
            'status'            => $row['status']
        ]);
    }

    //LIMIT CHUNKSIZE
    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }
}
