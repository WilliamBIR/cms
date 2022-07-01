<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role_user;
use App\Models\Sucursal;
use App\Models\Modelo;
use App\Models\Area;
use App\Models\Lista;
use App\Models\tipos_de_area;
use App\Models\tipos_de_modelo;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class AreaController extends Controller
{   
    public function index(Area $area)
    {
        $user = Auth::user();
        if($user){
            $role = Role_user::all()->where('user_id',$user->id)->first()->role_id;
            $tarea = tipos_de_area::all()->where('name',$area->name)->first();
            $sucursal = Sucursal::all()->where('det',$area->det)->first();
            $modelos = $area->modelo;

            if(count($modelos)>0)
                $filtro = filtro($modelos);
            else
                $filtro = [];
            
            $tmodelos = tipos_de_modelo::all()->where('area_id',$tarea->id)->whereNotIn('name',$filtro);
            return Inertia::render('Area',[
                'user' => ['name' => $user->name,'role'=>$role],
                'modelos' => $modelos,
                'tmodelos' =>$tmodelos,
                'area' =>['id'=>$area->id,'name'=>$area->name,'det'=>$area->det,'slug'=>$area->slug],
                'sucursal'=>['id'=>$sucursal->id,'name'=>$sucursal->namesucu,'det'=>$sucursal->det,'slug'=>$sucursal->slug],
            ]);
        }else
        {
            return Inertia::render('Auth/Login');
        }
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user){
            $area = Area::all()->where('id',(string)request('id'))->first();
            try {
                $modelo = Modelo::all()->where('det','=',request('det'))->where('name','=',request('name'));
                if(count($modelo)<1){
                    Modelo::created(['slug'=>Str::random(8),'store'=>$area->store,'nombre'=>$user->name,'rutamodel'=>tipos_de_modelo::all()->where('name','=',request('name'))->first()->url]);
                    $typeModel =tipos_de_modelo::all()->where('name',request('name'))->first();
                    if($typeModel->precios){
                        $modelo = Modelo::all()->where('det','=',request('det'))->where('name','=',request('name'))->first();
                        $path2 = 'sucursales\\' . request('det') . '\\' . request('name') . '\\';
                        Lista::created(['nombre'=>$user->name,'url'=>$path2,'modelo_id'=>$modelo->id,'cantxpage'=>$typeModel->cantxpage]);
                    }
                    return Redirect::route('area',['area'=>$area->slug])->with('success', 'El Departamento se genero sin problemas');
                }else{
                    return Redirect::route('area',['area'=>$area->slug])->with('error', 'Ya existe el departamento seleccionado');
                }
            } catch (Exception $e) {
                // return $e;
                return Redirect::route('area',['area'=>$area->slug])->with('error', 'No se genero la area, intentelo nuevamente, si el error persiste comuniquese con el administrador del sistema');
            }
        }else
        {
            return Inertia::render('Auth/Login');
        }
    }
}
