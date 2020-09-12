<?php

namespace App\Http\Controllers\Gbkp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Artikel;
use App\Models\IbadahUmum;
use Session;
use Harisa;
use DB;

class LandingController extends Controller
{

    public function index()
    {	

        $ibadahObj      = IbadahUmum::select("*", DB::raw("DATE_FORMAT(tanggal,'%d-%m-%Y') AS tanggal_ibadah "))->orderBy("tanggal","asc")->orderBy("waktu_mulai","asc")->limit(2)->get();

        $ibadah = array();

        foreach ($ibadahObj as $key => $value) {
            // echo json_encode($value);die;
            array_push($ibadah, json_decode(json_encode($value),true));
        }

        foreach ($ibadah as $key => $value) {
            $ibadah[$key]["songleader2"] = array();
            if(!empty($value["songleader"])){
                $songleader = json_decode($value["songleader"],true);
                if (is_array($songleader)) {
                    $ibadah[$key]["songleader2"] = $songleader;
                }
                
            }
        }
    	$artikel     = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->orderBy("updated_at","desc")->limit(3)->get();
    	$artikelmore = false;
    	if (count($artikel) > 1) {
    		$artikelmore = true;
    	}
        // echo json_encode($ibadah);die;
        return view('gbkp.home',compact('artikel','artikelmore','ibadah'));
    }

    public function artikelList()
    {

    	$artikelList     = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->orderBy("updated_at","desc")->get();
    	return view('gbkp.artikel-list', compact('artikelList'));
    }

    public function artikel($key = null)
    {	
        $page  = 1;
        $limit = 10;
    	if (empty($key)) {
    		$artikel     = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->orderBy("updated_at","desc")->take($limit)->get();
    		return view('gbkp.artikel-list', compact('artikelList'));
    	}

    	$artikel = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->whereUrlKey(urldecode($key))->first();

        if(!empty($artikel)){
             $artikel = $artikel->toArray();
        }else{
            $artikelList     = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->orderBy("updated_at","desc")->take($limit)->get();
            return view('gbkp.artikel-list', compact('artikelList'));
        }
    	$title 			= !empty($artikel["title"]) ? $artikel["title"] : null;
    	$description 	= !empty($artikel["short_description"]) ? $artikel["short_description"] : null;

        return view('gbkp.artikel',compact('artikel','title','description'));
    }

}
 