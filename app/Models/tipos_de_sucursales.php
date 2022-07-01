<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipos_de_sucursales extends Model
{
    use HasFactory;
    public static function created($request)
    {
        $st = new tipos_de_sucursales();
        $st->name = $request['name'];
        $st->ruta = $request['url'];
        $st->nombre = Auth::user()->name;
        $st->save();
    }
    public function sucursal(){ 
        return $this->hasMany(Sucursal::class,'name','store');
    }
}
