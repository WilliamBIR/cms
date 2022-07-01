<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FirmwareController extends Controller
{
    public function store(Request $request){
        $modelo = Modelo::all()->where('det',request('det'))->where('name',request('modelo'))->first();
        $path = 'sucursales\\' . $modelo->det . '\\' . $modelo->name . '\\';
        $jsUrl = public_path($path);
        // $vUrl = public_path('res\\videos\\');
        $vUrl = public_path('res\\firmware\\');
        !is_dir($jsUrl)?mkdir($jsUrl,0755,true):'';
        !is_dir($vUrl)?mkdir($vUrl,0755,true):'';

        $position = collect(json_decode($request->position,true));
        $position->transform(function($item,$key){return (object)$item;});
        $videos = Video::all()->where('modelo_id',$modelo->id)->sortBy('id');
        if(count($videos) > count($position)){
            $vid = Video::select('id','name','url')->where('modelo_id',$modelo->id)->orderBy('id','desc')->get();
            foreach($position as $p){
                $dife[]=Video::select('id','name','url')->where('modelo_id',$modelo->id)->where('url',$p->url)->get()->first();
            }
            $rest = $vid->diff(collect($dife));
            foreach($rest as $r){
                Video::find($r->id)->delete();
                $old = Video::select('id','name','url')->where('url',$r->url)->get();
                if(count($old)==0){
                    is_file(public_path('res\\videos\\'.$r->url))?unlink(public_path('res\\videos\\'.$r->url)):'';
                }
            }
        }
        foreach($position as $pos){
            $ext = substr($pos->url, -4);
            // $vid = $videos->sortBy('id')->skip($pos->position)->first();
            // if($vid){
            //     $vid->url = $pos->url;
            //     $vid->name = $pos->position . $ext;
            //     $vid->validity = $pos->validity ?? '';
            //     $vid->nombre = Auth::user()->name;
            //     $vid->save();
            // }else{
            //     Video::created(['name'=>$pos->position . $ext,'url'=>$pos->url,'modelo_id'=>$modelo->id,'det'=>$modelo->det,'vigencia'=>$pos->validity,'modelo'=>$modelo->name,'nombre'=>Auth::user()->name]);
            // }
            if(!is_file(public_path('/res/videos/'.$pos->url))){
                if($request->file('video'.$pos->position)){
                    $file = $request->file('video'.$pos->position);
                    $file->move(public_path('\\res\\videos\\'),$pos->url);
                }else{
                    is_file(public_path($path.$pos->position . $ext))?rename(public_path($path.$pos->position . $ext),public_path('res\\videos\\'.$pos->url)):'';
                }
            }else{
                is_file(public_path($path.$pos->position . $ext))?unlink(public_path($path.$pos->position . $ext)):'';
            }
        }
        return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('success', 'Se guardaron los cambios');
    }

    public function delete(Video $video){
        $modelo = Modelo::find($video->modelo_id);
        $path = 'sucursales\\' . $modelo->det . '\\' . $modelo->name . '\\';
        $videos = Video::select('name','url')->where('modelo_id',$video->modelo_id);
        foreach($videos as $vi){
            is_file(public_path($path.$vi->name))?rename(public_path($path.$vi->name),public_path('res\\videos\\'.$vi->url)):'';
        }
        $url = $video->url;
        $video->delete();
        $old = Video::select('id','name','url')->where('url',$url)->get();
        if(count($old)==0){
            is_file(public_path('res\\videos\\'.$url))?unlink(public_path('res\\videos\\'.$url)):'';
        }
        return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('success', 'Se elimino el video');
    }
}

// <!-- @LUIS PARA CREAR UNA RUTA DE DESCARGA DE FIRMAWARE DE LAS IPK'S -->
