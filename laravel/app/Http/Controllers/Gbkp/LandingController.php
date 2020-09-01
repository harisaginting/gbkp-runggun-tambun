<?php

namespace App\Http\Controllers\Gbkp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Artikel;
use Session;
use Harisa;
use DB;

class LandingController extends Controller
{

    public function index()
    {	
    	$artikel     = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->orderBy("updated_at","desc")->limit(3)->get();
    	$artikelmore = false;
    	if (count($artikel) > 5) {
    		$artikelmore = true;
    	}

        return view('gbkp.home',compact('artikel','artikelmore'));
    }

    public function artikelList()
    {

    	$artikelList     = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->orderBy("updated_at","desc")->get();
    	return view('gbkp.artikel-list', compact('artikelList'));
    }

    public function artikel($key = null)
    {	

    	if (empty($key)) {
    		$artikelList     = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->orderBy("updated_at","desc")->get();
    		return view('gbkp.artikel-list', compact('artikelList'));
    	}

    	$artikel = Artikel::select("*", DB::raw("DATE_FORMAT(updated_at,'%d-%m-%Y') AS publish_at "))->whereUrlKey(urldecode($key))->first()->toArray();
    	$title 			= !empty($artikel["title"]) ? $artikel["title"] : null;
    	$description 	= !empty($artikel["short_description"]) ? $artikel["short_description"] : null;

        return view('gbkp.artikel',compact('artikel','title','description'));
    }

}
 