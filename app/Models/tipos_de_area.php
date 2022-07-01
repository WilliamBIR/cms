<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class tipos_de_area extends Model
{
    use HasFactory;
    public static function created($request)
    {
        $T_area = new tipos_de_area;
        $T_area->name = $request['name'];
        $T_area->url = $request['url'];
        $T_area->store = $request['store'];
        $T_area->nombre = Auth::user()->name;
        $T_area->save();
    }

    public function modelos(){
        return $this->hasMany(tipos_de_modelo::class,'id','area_id');
   }
}
