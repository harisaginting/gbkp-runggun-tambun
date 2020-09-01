<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class eventExport implements FromCollection
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$header = array(
    		'Attendance','Kehadiran',
    		'Nama','Nama',
    		'Klasis','Klasis',
    		'Jabatan','Jabatan',
    		'Gender','Jenis Kelamin',
    		'Handphone',' No Telepon',
    	);

    	// echo json_encode($header);die;
    	$data = DB::table('event_rakor3')
                    ->select(DB::raw("CASE WHEN attend = 1 THEN date_updated ELSE 'belum hadir' END AS Attendance"),
                            "name as Nama","klasis as Klasis","jabatan as Jabatan","gender as Gender",
                            "phone as Nomor Handphone","room AS Kamar")->get();
       return $data;
    }
}
