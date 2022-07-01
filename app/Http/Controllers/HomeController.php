<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSucursalRequest;
use Illuminate\Http\Request;
use App\Models\Role_user;
use App\Models\Sucursal;
use App\Models\tipos_de_sucursales;
use App\Models\Area;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user){
            $role = Role_user::all()->where('user_id',$user->id)->first()->role_id;
            $areas = Area::select('slug','det')->get();
            $sucursales = Sucursal::select('id','namesucu','det','rutasucu','slug')->orderBy('namesucu','ASC')->get();
            $sucursales->load('areas');
            if($role<4 && $role>1){$tienda  = "walmart";}
            elseif($role>3){$tienda = "europea";}

            return Inertia::render('Home',[
                'user' => ['id'=>$user->id,'name' => $user->name,'password'=>$user->password,'role'=>$role],
                'sucursales' => $sucursales
            ]);
        }else{return Inertia::route('Auth/Login');}
    }
    
    public function store(StoreSucursalRequest $request)
    {
        $user = Auth::user();
        if($user){
            try {
                $sucursal = Sucursal::created(['slug'=>Str::random(8),'rutasucu'=>tipos_de_sucursales::all()->where('name',request('store'))->first()->ruta,'nombre'=>$user->name]);
                // return $sucursal;
                return Redirect::route('home')->with('success', 'La Sucursal se genero sin problemas');
            } catch (Exception $e) {
                // return $e;
                return Redirect::route('home')->with('error', 'No se genero la sucursal, intentelo nuevamente, si el error persiste comuniquese con el administrador del sistema');
            }
        }else
        {
            return Inertia::render('Auth/Login');
        }
    }
    
}
