<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use App\Models\Lista;
use App\Models\Modelo;
use App\Models\Precio;
use App\Models\tipos_de_modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PrecioController extends Controller
{
    public function store(Request $request){
        $modelo = Modelo::all()->where('det',request('det'))->where('name',request('modelo'))->first();
        $lista = Lista::all()->where('det',request('det'))->where('modelo_id',$modelo->id);
        $path = 'sucursales\\' . request('det') . '\\' . request('modelo') . '\\';
        $precios = (object)$request->precios;
        $especial = isset($precios->especial)?collect($precios->especial):null;
        if(count($lista)<1){
            Lista::created(['det'=>$request->get('det'),'url'=>$path,'modelo_id'=>$modelo->id]);
            $lista = Lista::all()->where('det','=',$request->get('det'))->where('modelo_id','=',$modelo->id);
        }else
        $lista = $lista->first();
        if($especial){
            $especial->transform(function($item,$key){return (object)$item;});
            foreach($especial as $key => $value){
                $lista['nameFijo'.($key+1)] = $value->name;
                $lista['pfijo'.($key+1)] = $value->price;
                $lista['cfijo'.($key+1)] = $value->pennies;
            }
            $lista->save();
        }
        $extras = isset($precios->extras)?collect($precios->extras):null;
        if($extras){
            foreach($extras as $index2 => $ext){
                $extra = Extra::select('id','name','precio','nombre')->where('modelo_id',$modelo->id)->orderBy('id')->skip($index2)->get();
                if(count($extra)>0){
                    $extra = $extra->first();
                    $extra->name = $ext['name'];
                    $extra->precio = $ext['precio'];
                    $extra->nombre = Auth::user()->name;
                    $extra->save();
                }else{
                    Extra::created(["name"=>$ext['name'],"precio"=>$ext['precio'],"det"=>request('det'),"modelo_id"=>$modelo->id,"nombre"=>Auth::user()->name]);
                }
            }
            $extra = Extra::select('id','name','precio','nombre')->where('modelo_id',$modelo->id)->orderBy('id')->get();
            if(count($extras)<count($extra)){
                for(;count($extras)<count($extra);){
                    $extra->last()->delete();
                    $extra = Extra::select('id','name','precio','nombre')->where('modelo_id',$modelo->id)->orderBy('id')->get();
                }
            }
        }
        $normales = isset($precios->normales)?collect($precios->normales):null;
        if($normales){
            foreach($normales as $index => $norm){
                $precio = Precio::select('id','name','precio','centavo','nombre')->where('modelo_id',$modelo->id)->orderBy('id')->skip($index)->get();
                if(count($precio)>0){
                    $precio = $precio->first();
                    $precio->name = $norm['name'];
                    $precio->precio = $norm['precio'];
                    $precio->centavo = isset($norm['centavo'])?$norm['centavo']:'';
                    $precio->nombre = Auth::user()->name;
                    $precio->save();
                }else{
                    Precio::created(["name"=>$norm['name'],"precio"=>$norm['precio'],"centavo"=>isset($norm['centavo'])?$norm['centavo']:'',"det"=>request('det'),"modelo_id"=>$modelo->id,"nombre"=>Auth::user()->name]);
                }
            }
            $precios = Precio::select('id','name','precio','centavo','nombre')->where('modelo_id',$modelo->id)->orderBy('id')->get();
            if(count($normales)<count($precios)){
                for(;count($normales)<count($precios);){
                    $precios->last()->delete();
                    $precios = Precio::select('id','name','precio','centavo','nombre')->where('modelo_id',$modelo->id)->orderBy('id')->get();
                }
            }
        }
        return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('success', 'Se guardaron los cambios');
    }
}