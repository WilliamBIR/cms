<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'det','rutamodel', 'slug','v_update'];
    //
    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public static function created($request)
    {
        $modelo = new Modelo();
        $modelo->name=request('name');
        $modelo->det=request('det');
        $modelo->rutamodel = $request['rutamodel'];
        $modelo->slug=$request['slug'];
        $modelo->store = $request['store'];
        $modelo->v_template = "0";
        $modelo->v_update = "1";
        $modelo->nombre = $request['nombre'];
        $modelo->save();
        $modelo->area()->attach(request('id'),['status'=>true]);
        return $modelo;
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function video(){ 
        return $this->hasMany(Video::class,'modelo_id','id'); 
    }
    public function image(){ 
        return $this->hasMany(Imagen::class,'modelo_id','id'); 
    }
    public function list(){ 
        return $this->hasMany(Lista::class,'modelo_id','id'); 
    }
    public function price(){ 
        return $this->hasMany(Precio::class,'modelo_id','id'); 
    }
    public function extra(){ 
        return $this->hasMany(Extra::class,'modelo_id','id'); 
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class,'det','det');
    } 
 
    public function area(){ 
        return $this->belongsToMany(Area::class,'pivots')
        ->withPivot('area_id','status'); 
    }
}
