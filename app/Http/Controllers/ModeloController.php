<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role_user;
use App\Models\Sucursal;
use App\Models\Modelo;
use App\Models\Area;
use App\Models\Extra;
use App\Models\Grupo;
use App\Models\Imagen;
use App\Models\Precio;
use App\Models\tipos_de_modelo;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ModeloController extends Controller
{
    public function index(Modelo $modelo)
    {
        $user = Auth::user();
        if($user){
            $role = Role_user::all()->where('user_id',$user->id)->first()->role_id;
            $grupos = Grupo::select('id','modelo','name')->where('modelo',$modelo->name)->get();
            $sucursal = Sucursal::all()->where('det',$modelo->det)->first();
            $modelos = Modelo::select('det')->where('name',$modelo->name)->get();
            $modelos->load('sucursal');
            foreach($modelos as $m){
                $sucursales[]= ["id"=>$m->sucursal->id,"name"=>$m->sucursal->namesucu];
            }
            $area = Area::select('id','name','slug')->where('id',$modelo->area()->first()->id)->first();
            $type = tipos_de_modelo::all()->where('name',$modelo->name)->first();
            $especial=$type->nespecial;
            $tipo = (object) [];
            if($type->videos){
                $tipo->Videos = (object) [];
                $tipo->Videos->data = Video::select('id','name','url','validity')->where('modelo_id',$modelo->id)->orderBy('id','asc')->get();
                $tipo->Videos->length = count($modelo->video);
                $tipo->Videos->Multi = $type->nvideos;
            }
            if($type->imagenes){
                $tipo->Imagenes = (object) [];
                $tipo->Imagenes->data = Imagen::select('id','name','url')->where('modelo_id',$modelo->id)->orderBy('id','asc')->get();
                $tipo->Imagenes->length = count($modelo->image);
                $tipo->Imagenes->Multi = $type->nimagenes;
            }
            if($type->precios){
                $tipo->Precios = (object) [];
                $tipo->Precios->Normales  = Precio::select('id','name','precio','centavo')->where('modelo_id',$modelo->id)->orderBy('id','asc')->get();
                if($type->extra)
                    $tipo->Precios->Extra = Extra::select('id','name','precio')->where('modelo_id',$modelo->id)->orderBy('id','asc')->get();
                if($type->especial){
                    $tipo->Precios->Especial = [];
                    if($modelo->list->first()->nameFijo1)
                        array_push($tipo->Precios->Especial,["name"=>$modelo->list->first()->nameFijo1,"price"=>$modelo->list->first()->pfijo1,"pennies"=>$modelo->list->first()->cfijo1]);
                    if($modelo->list->first()->nameFijo2)
                        array_push($tipo->Precios->Especial,["name"=>$modelo->list->first()->nameFijo2,"price"=>$modelo->list->first()->pfijo2,"pennies"=>$modelo->list->first()->cfijo2]);
                }
            }
            return Inertia::render('Modelo',[
                'user' => ['name' => $user->name,'role'=>$role],
                'grupos'=>$grupos,
                'sucursales'=>$sucursales,
                'sucursal'=>['id'=>$sucursal->id,'name'=>$sucursal->namesucu,'det'=>$sucursal->det,'slug'=>$sucursal->slug],
                'area'=>$area,
                'modelo'=>['id'=>$modelo->id,'name'=>$modelo->name,'det'=>$modelo->det,'slug'=>$modelo->slug,'type'=>$tipo,'especial'=>$especial,'updated'=>$modelo->updated_at]
            ]);
        }else
        {
            return Inertia::render('Auth/Login');
        }
    }
}
