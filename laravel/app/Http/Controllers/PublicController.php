<?php

namespace App\Http\Controllers;

use App\GeneralConfig;
use App\Image;
use App\Mail\ContactMail;
use App\Service;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(){
    	$tmp_get=GeneralConfig::all();
    	$services=Service::all();
        $images_slides=Image::where('type',1)->get();
        $img_nosotros=Image::where('type',2)->first();
        $img_cotiza=Image::where('type',3)->first();

    	foreach ($tmp_get as $value) {
    		$general[$value['name']]=$value['value'];
    	}

    	return view('welcome',compact('general','services','images_slides','img_nosotros','img_cotiza'));
    }
    public function contact(Request $request){
    	$validator=Validator::make($request->all(),[
            'email' => 'required|email',
            'name'  => 'required',
            'phone' => 'required|digits:9',
            'message' =>'required'
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        Mail::to('gian.ubillus.leo@gmail.com')->send(new ContactMail($request->only('email','name','phone','message')));
        $msn='Formulario enviado!';
        return redirect(url()->previous())->with('status',$msn);
    }
}
