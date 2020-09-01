<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class AgendaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('agenda.index');
    }

    function list_agenda(Request $request){
        $data = DB::table('acara as main')->select('id','main.nama as title',DB::raw("DATE_FORMAT(mulai,'%Y-%m-%dT%H:%i:%s') as start"),DB::raw("DATE_FORMAT(selesai,'%Y-%m-%dT%H:%i:%s') as end"),'deskripsi','tipe','skala')->get();

        echo json_encode($data);
    }

    function update_agenda(Request $request){
        $data['nama']       = $request->input('acara_nama');
        $data['deskripsi']  = $request->input('acara_deskripsi');
        $data['mulai']      = $request->input('acara_tanggal_mulai').' '.$request->input('acara_jam_mulai').':00';
        $data['selesai']    = $request->input('acara_tanggal_selesai').' '.$request->input('acara_jam_selesai').':00';
        $data['tipe']       = $request->input('acara_tipe');
        $data['skala']      = $request->input('acara_skala');

        if(empty($request->input('acara_id'))){
            DB::table('acara')->insert($data);
        }else{
            DB::table('acara')
            ->where('id', $request->input('acara_id'))
            ->update($data);
        }
        Session::flash('notification', 'Agenda data has been updated');
        $result['data'] = 'success';
        echo json_encode($result);
    }

    function update_jam_agenda(Request $request){
        $id                 = $request->input('id');
        $data['mulai']      = $request->input('mulai');
        $data['selesai']    = $request->input('selesai');
        
        // DB::enableQueryLog();
        DB::table('acara')
            ->where('id', $id)
            ->update($data);
        
        Session::flash('notification', 'Agenda data has been updated');
        $result['data'] = 'success';
        echo json_encode($result);
        // $query = DB::getQueryLog();
        // echo json_encode($query);
    }

    function delete_agenda(Request $request){
        $id                 = $request->input('id');
        
        DB::enableQueryLog();
        DB::table('acara')
            ->where('id', $id)
            ->delete();
        
        Session::flash('notification', 'Agenda '.$request->input('nama').' data has been deleted');
        $result['data'] = 'success';
        echo json_encode($result);
        // $query = DB::getQueryLog();
        // echo json_encode($query);
    }



}
