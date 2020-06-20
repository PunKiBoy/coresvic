<?php

namespace App\Http\Controllers;

use App\GeneralConfig;
use Illuminate\Http\Request;

class AuthControl extends Controller
{
    function generalIndex (){
    	$tmp_get=GeneralConfig::all();

    	foreach ($tmp_get as $value) {
    		$data[$value['name']]=$value['value'];
    	}

    	return view('auth.generalIndex',compact('data'));
    }
    function saveGeneralConf(Request $request){
    	foreach ($request->all() as $key => $value) {
    		$tmp_name=str_replace('txt_', '', $key);
    		$tmp_row=GeneralConfig::where('name',$tmp_name)->first();
    		if($tmp_row){
    			$obj=$tmp_row;
    		}else{
    			$obj=new GeneralConfig();
    		}
    		$obj->name=$tmp_name;
    		$obj->value=$value;
    		$obj->save();
    		
    	}
    	$msg='Configuracion Actulizada';
    	return redirect('/home')->with('status',$msg);
    }
}
