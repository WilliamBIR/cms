<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['archivo', 'namea', 'nameArchivo'];

    public static function created($request)
    {
        $vid = new Video;
        $vid->name = $request['name'];
        $vid->url = $request['url'];
        $vid->modelo_id = $request['modelo_id'];
        $vid->det = $request['det'];
        $vid->validity = $request['vigencia'];
        $vid->modelo = $request['modelo'];
        $vid->nombre = $request['nombre'];
        $vid->save();
    }

    public function modelo(){
        return $this->belongsTo(Modelo::class); 
    } 
}
