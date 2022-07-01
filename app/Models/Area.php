<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['name','det','rutaarea', 'slug'];
    // protected $with = ['sucursal'];
    //
    /**
 	* Get the route key for the model.
 	*
 	* @return string
 	*/
    public static function created($request)
    {
        $area = new Area();
        $area->name=request('name');
        $area->det=request('det');
        $area->rutaarea = $request['rutaarea'];
        $area->slug=$request['slug'];
        $area->store = $request['store'];
        $area->nombre = $request['nombre'];
        $area->save();
        $area->sucursal()->attach(request('id'),['status'=>true]);
        return $area;
    }
    public function getRouteKeyName()
	{
    	return 'slug';
    }

    public function sucursal(){
        return $this->belongsToMany(Sucursal::class,'pivots')
        ->withPivot('sucursal_id','status');
    }
    
    public function modelo(){
        return $this->belongsToMany(Modelo::class,'pivots');
    }
}
