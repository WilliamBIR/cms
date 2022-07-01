<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    protected $table = "images";

    public static function created($request)
    {
        $img = new Imagen;
        $img->name = $request['name'];
        $img->url = $request['url'];
        $img->modelo_id = $request['modelo_id'];
        $img->det = $request['det'];
        $img->modelo = $request['modelo'];
        $img->nombre = $request['nombre'];
        $img->save();
    }

    protected $fillable = ['archivo', 'namea', 'nameArchivo'];

    public function modelo(){
        return $this->belongsTo(Modelo::class); 
    } 
}
