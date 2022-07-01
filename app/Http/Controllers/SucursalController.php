<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Role_user;
use App\Models\Sucursal;
use App\Models\tipos_de_area;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Throwable;

class SucursalController extends Controller
{
    public function index(Sucursal $Sucursal)
    {
        $user = Auth::user();
        if($user){
            $role = Role_user::all()->where('user_id',$user->id)->first()->role_id;

            $area = DB::table('areas')->select('id','name','det','rutaarea','slug')
            ->where('det','=',$Sucursal->det)
            ->orderBy('name', 'asc')
            ->get();

            $filtro = filtro($area);

            if($Sucursal->store=='walmart'){
                $tareas = tipos_de_area::select('id','name','store')->where('store','walmart')->whereNotIn('name',$filtro)->get();
            }elseif($Sucursal->store=='europea'){
                $tareas = tipos_de_area::select('id','name','store')->where('store','europea')->whereNotIn('name',$filtro)->get();
            }else{
                $tareas = tipos_de_area::select('id','name','store')->where('store','express')->whereNotIn('name',$filtro)->get();
            }

            return Inertia::render('Sucursal',[
                'user' => ['name' => $user->name,'role'=>$role],
                'sucursal' => ['id'=>$Sucursal->id,'name'=>$Sucursal->namesucu,'det'=>$Sucursal->det,'slug'=>$Sucursal->slug],
                'tareas' =>$tareas,
                'areas' =>$area
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
            $sucursal = Sucursal::all()->where('id',(string)request('id'))->first();
            try {
                $area = Area::all()->where('det','=',request('det'))->where('name','=',request('name'));
                if(count($area)<1){
                    Area::created(['store'=>$sucursal->store,'rutaarea'=>tipos_de_area::all()->where('name','=',request('name'))->first()->url,'nombre'=>$user->name,'slug'=>Str::random(8)]);
                    return Redirect::route('sucursal',['sucursal'=>$sucursal->slug])->with('success', 'La Area se genero sin problemas');
                }else{
                    return Redirect::route('sucursal',['sucursal'=>$sucursal->slug])->with('error', 'Ya existe el area seleccionada');
                }
            } catch (Throwable $e) {
                // return $e;
                return Redirect::route('sucursal',['sucursal'=>$sucursal->slug])->with('error', 'No se genero la area, intentelo nuevamente, si el error persiste comuniquese con el administrador del sistema');
            }
        }else
        {
            return Inertia::render('Auth/Login');
        }
    }
}
