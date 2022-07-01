<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'det'];

    public static function created($request)
    {
        $grupos = new Grupo;
        $grupos->name = $request['namegrupo'];
        $grupos->modelo = $request['namemodelo'];
        $grupos->nombre = $request['nombre'];
        $grupos->save();    
    }

    public function agrupados()
    {
        return $this->hasMany(Agrupados::class,'namegrupo','namegrupo');
    }
}
