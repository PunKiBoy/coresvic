<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images=Image::all();
        return view('auth.imageIndex',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.imageCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'  => 'required',
            'description' => 'required',
            'type' =>'required|gte:1',
            'miimagen'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->get('type')!=1){
            $tmp_obj=Image::where('type',$request->get('type'))->get();
            if(count($tmp_obj)>0){
                return redirect(url()->previous())->withErrors(['No válido', 'Ya existe una imagen de este tipo.'])->withInput();
            }
        }

        $file=$request->file('miimagen')->storeAs('public/imgs',Str::random(5).'.'.$request->file('miimagen')->extension());
        
        if($file){

            $obj = new Image();
            $obj->name=$request->get('name');
            $obj->description=$request->get('description');
            $obj->type=$request->get('type');
            $obj->url=str_replace('public/', '', $file);
            $obj->save();
        }

        return redirect('/auth/imagenes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image,$id)
    {
        $image=Image::findOrFail($id);
        return view('auth.imageEdit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image,$id)
    {
        $validator=Validator::make($request->all(),[
            'name'  => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        $obj=Image::findOrFail($id);
        if($request->file('miimagen')){
            Storage::delete('public/'.$obj->url);
            $file=$request->file('miimagen')->storeAs('public/imgs',Str::random(5).'.'.$request->file('miimagen')->extension());
        }else{
            $file=$obj->logo;
        }
        $obj->name=$request->get('name');
        $obj->description=$request->get('description');
        $obj->type=$request->get('type');
        $obj->url=str_replace('public/', '', $file);
        $obj->save();
        return redirect('/auth/imagenes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image,$id)
    {
        $obj=Image::findOrFail($id);
        Storage::delete('public/'.$obj->url);
        $obj->delete();
        return redirect('/auth/imagenes');

    }
}
