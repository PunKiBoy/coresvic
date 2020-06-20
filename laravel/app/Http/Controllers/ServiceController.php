<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ServiceController extends Controller
{
    public function index(){
    	$services=Service::all();
    	return view('auth.servicesIndex',compact('services'));
    }
    public function create(){
    	return view('auth.servicesCreate');
    }
    public function store(Request $request){
    	$validator=Validator::make($request->all(),[
            'name'  => 'required',
            'description' => 'required',
            'color' =>'required|starts_with:#|size:7',
            'icono' =>'required'
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }

        $file=$request->file('icono')->storeAs('public/imgs',Str::random(5).'.'.$request->file('icono')->extension());
        
        if($file){

            $obj = new Service();
            $obj->name=$request->get('name');
            $obj->description=$request->get('description');
            $obj->color=$request->get('color');
            $obj->icon=str_replace('public/', '', $file);
            $obj->save();
        }

        return redirect('/auth/servicios');
    }
    public function edit($id){
        $service=Service::findOrFail($id);
        return view('auth.servicesEdit',compact('service'));
    }
    public function update(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'name'  => 'required',
            'description' => 'required',
            'color' =>'required|starts_with:#|size:7'
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        $obj = Service::findOrFail($id);
        if($request->file('icono')){
            Storage::delete('public/'.$obj->icon);
            $file=$request->file('icono')->storeAs('public/imgs',Str::random(5).'.'.$request->file('icono')->extension());
        }else{
            $file=$obj->logo;
        }
        $obj->name=$request->get('name');
        $obj->description=$request->get('description');
        $obj->color=$request->get('color');
        $obj->icon=str_replace('public/', '', $file);
        $obj->save();

        return redirect('/auth/servicios');
    }
}
