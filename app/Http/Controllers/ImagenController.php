<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Imagen;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ImagenController extends Controller
{
    public function store(Request $request){
        $modelo = Modelo::all()->where('det',request('det'))->where('name',request('modelo'))->first();
        $path = 'sucursales\\' . $modelo->det . '\\' . $modelo->name . '\\';
        $jsUrl = public_path($path);
        $vUrl = public_path('res\\imagenes\\');
        !is_dir($jsUrl)?mkdir($jsUrl,0755,true):'';
        !is_dir($vUrl)?mkdir($vUrl,0755,true):'';
        $position = collect(json_decode($request->position,true));
        $position->transform(function($item,$key){return (object)$item;});
        $imagenes = Imagen::all()->where('modelo_id',$modelo->id)->sortBy('id');
        if(count($imagenes)>0){
            foreach($imagenes as $img){
                $change[]= collect(['id'=>$img->id,'url'=>$img->url,'name'=>$img->name]);
            }
            $change = collect($change);
        }
        if(count($imagenes) > count($position)){
            $img = Imagen::select('id','name','url')->where('modelo_id',$modelo->id)->orderBy('id','desc')->get();
            foreach($position as $p){
                $dife[]=Imagen::select('id','name','url')->where('modelo_id',$modelo->id)->where('url',$p->url)->get()->first();
            }
            $rest = $img->diff(collect($dife));
            foreach($rest as $r){
                Imagen::find($r->id)->delete();
                $old = Imagen::select('id','name','url')->where('url',$r->url)->get();
                if(count($old)==0){
                    is_file(public_path('res\\imagenes\\'.$r->url))?unlink(public_path('res\\imagenes\\'.$r->url)):'';
                }
            }
        }
        foreach($position as $pos){
            $ext = substr($pos->url, -4);
            $img = $imagenes->sortBy('id')->skip($pos->position)->first();
            if($img){
                $img->url = $pos->url;
                $img->name = $pos->position . $ext;
                $img->nombre = Auth::user()->name;
                $img->save();
            }else{
                Imagen::created(['name'=>$pos->position . $ext,'url'=>$pos->url,'modelo_id'=>$modelo->id,'det'=>$modelo->det,'modelo'=>$modelo->name,'nombre'=>Auth::user()->name]);
            }
            
            if(!is_file(public_path('/res/imagenes/'.$pos->url))){
                if($request->file('imagen'.$pos->position)){
                    $file = $request->file('imagen'.$pos->position);
                    $file->move(public_path('\\res\\imagenes\\'),$pos->url);
                }else{
                    is_file(public_path($path.$pos->position . $ext))?rename(public_path($path.$pos->position . $ext),public_path('res\\imagenes\\'.$pos->url)):'';
                }
            }
        }
        return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('success', 'Se guardaron los cambios');
    }

    public function delete(Imagen $image){
        $modelo = Modelo::find($image->modelo_id);
        $path = 'sucursales\\' . $modelo->det . '\\' . $modelo->name . '\\';
        $imagenes = Imagen::select('name','url')->where('modelo_id',$image->modelo_id);
        foreach($imagenes as $im){
            is_file(public_path($path.$im->name))?rename(public_path($path.$im->name),public_path('res\\imagenes\\'.$im->url)):'';
        }
        $url = $image->url;
        $image->delete();
        $old = Imagen::select('id','name','url')->where('url',$url)->get();
        if(count($old)==0){
            is_file(public_path('res\\imagenes\\'.$url))?unlink(public_path('res\\imagenes\\'.$url)):'';
        }
        return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('success', 'Se elimino la Imagen');
    }
}
