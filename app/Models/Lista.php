<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;
    public static function created($request)
    {
        $list = new Lista;
        $list->name = 'lista';
        $list->det = request('det');
        $list->url = $request['url'];
        $list->modelo_id = $request['modelo_id'];
        $list->page = '1';
        $list->nombre = $request['nombre'];
        $list->save();
    }
    
    public function precio(){ 
        return $this->hasMany(Precio::class,'modelo_id','modelo_id'); 
    }
    
    public function extra(){ 
        return $this->hasMany(Extra::class,'modelo_id','modelo_id'); 
    }
}
