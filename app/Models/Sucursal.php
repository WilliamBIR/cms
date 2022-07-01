<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sucursal extends Model
{
    use HasFactory;
    protected $fillable = ['namesucu', 'det', 'rutasucu', 'slug'];

	public static function created($request)
    {
        $Sucursal = new Sucursal();
        $Sucursal->namesucu = request('namesucu');
        $Sucursal->det = request('det');
        $Sucursal->rutasucu = $request['rutasucu'];
        $Sucursal->store = request('store');
        $Sucursal->slug = $request['slug'];
        $Sucursal->nombre = $request['nombre'];
        $Sucursal->save();
		
        if($Sucursal->det == 0){
            $Sucursal->det = $Sucursal->id;
            $Sucursal->nombre = Auth::user()->name;
            $Sucursal->save();
		}
		
        if (request('store')=='europea'){
            Area::created(['name'=>'Default','det'=>request('det'),'id'=>$Sucursal->id,'store'=>$Sucursal->store]);
        }
        return $Sucursal;
    }
    
    public function getRouteKeyName()
	{
    	return 'slug';
	}

	public function area(){
        return $this->hasMany(Area::class,'det','det'); 
    }

    public function modelo(){
        return $this->hasMany(Modelo::class,'det','det'); 
    }

    public function areas(){
        return $this->hasMany(Area::class,'det','det')->where('name','Default');
    }
}
