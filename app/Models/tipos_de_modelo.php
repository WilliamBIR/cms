<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class tipos_de_modelo extends Model
{
    use HasFactory;
    protected $with = ['area'];
    public static function created($request)
    {
        $T_model = new tipos_de_modelo;
        $T_model->id =tipos_de_modelo::all()->sortBy('id')->last()->id+1;
        $T_model->name = $request['name'];
        $T_model->url = $request['url'];
        $T_model->area_id = $request['area'];
        $T_model->store = $request['store'];
        $T_model->nombre = Auth::user()->name;
        $T_model->save();
    }

    public function area(){ 
        return $this->belongsTo(tipos_de_area::class,'area_id','id'); 
    }
}
