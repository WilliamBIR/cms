<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;
    public static function created($request)
    {

        $extra = new Extra;
        $extra->name = $request['name'];
        $extra->precio = $request['precio'];
        $extra->det = $request['det'];
        $extra->modelo_id = $request['modelo_id'];
        $extra->nombre = $request['nombre'];
        $extra->save();
    }

    public function lista(){ 
        return $this->belongsTo(Lista::class,'det','det'); 
    }
}
