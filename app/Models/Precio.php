<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;
    public static function created($request)
    {

        $precio = new Precio;
        $precio->name = $request['name'];
        $precio->precio = $request['precio'];
        $precio->centavo = $request['centavo'];
        $precio->det = $request['det'];
        $precio->modelo_id = $request['modelo_id'];
        $precio->nombre = $request['nombre'];
        $precio->save();
    }

    public function lista(){ 
        return $this->belongsTo(Lista::class,'det','det'); 
    }
}
