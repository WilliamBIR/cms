<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Agrupado extends Model
{
    use HasFactory;

    protected $fillable = ['namesucu','namegrupo','det','namemodelo'];
    
    public static function created($request)
    {
        $grupos = new Agrupado;
        $grupos->namesucu = $request['namesucu'];
        $grupos->namegrupo = $request['namegrupo'];
        $grupos->det = $request['det'];
        $grupos->namemodelo = $request['namemodelo'];
        $grupos->nombre = $request['name'];
        $grupos->save();        
    }
    
    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'namegrupo','namegrupo');
    }
}
