<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Agrupado;
use App\Models\Area;
use App\Models\Extra;
use App\Models\Grupo;
use App\Models\Imagen;
use App\Models\Lista;
use App\Models\Modelo;
use App\Models\Precio;
use App\Models\Sucursal;
use App\Models\tipos_de_modelo;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Throwable;
use ZipArchive;

class EnvioController extends Controller
{
    public function store(Request $request){
        set_time_limit(0);
        $modelo = Modelo::select('id','name','det','slug')->find($request->get('id'));
        $type = tipos_de_modelo::all()->where('name',$modelo->name)->first();
        $path = 'sucursales\\' . $modelo->det . '\\' . $modelo->name . '\\';
        if(!is_dir(public_path($path))){mkdir(public_path($path),0755,true);}
        $fileName = public_path($path . 'scap.zip');
        $zip = new ZipArchive();
        $plantilla = public_path('plantillas/'. $modelo->name .'/');
        if($modelo->area->first()->name=='Default'){$plantilla = public_path('plantillas/Default/');}
        $zip->open($fileName,ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($plantilla),RecursiveIteratorIterator::LEAVES_ONLY);
        foreach ($files as $file) {
            if ($file->isDir()) {
                continue;
            }
            $rutaAbsoluta = $file->getRealPath();
            if($modelo->area->first()->name=='Default'){
                $nombreArchivo = substr($rutaAbsoluta, strlen(public_path('plantillas\\Default\\')));
                
            }else{
                $nombreArchivo = substr($rutaAbsoluta, strlen(public_path('plantillas\\'.$modelo->name.'\\')));
            }
            $zip->addFile($rutaAbsoluta, str_replace("\\", "/", $nombreArchivo));
        }
        $zip->close();
        $area = $modelo->area->first();
        $updateVideos = request('contentUpdate') == "full" || request('contentUpdate') == "Videos"?true:false; 
        $updateImagenes = request('contentUpdate') == "full" || request('contentUpdate') == "Imagenes"?true:false;
        $updatePrecios = request('contentUpdate') == "full" || request('contentUpdate') == "Precios"?true:false;
        $agrupado = request('typeUpdate')=="sucursal"?collect((object)request('stores')):Agrupado::all()->where('namegrupo',request('group'))->where('namemodelo','=',$modelo->name)->sortBy('id');
        if(request('newGroup')){
            foreach($agrupado as $agru){
                $s = Sucursal::select('id','namesucu','det')->find($agru);
                $a = Agrupado::created(['namesucu'=>$s->namesucu,'namegrupo'=>request('newGroup'),'det'=>$s->det,'namemodelo'=>$modelo->name,'name'=>Auth::user()->name]);
            }
            Grupo::created(['namegrupo'=>request('newGroup'),'namemodelo'=>$modelo->name,'store'=>$s->store,'nombre'=>Auth::user()->name]);
        }
        for($k=0;$k<count($agrupado);$k++){
            $id = request('typeUpdate')=="sucursal"?$agrupado[$k]:$agrupado->skip($k)->first();
            $sucursal2 = Sucursal::find($id);
            $area2 = Area::all()->where('det','=',$sucursal2->det)->where('name','=',$area->name);
            if(count($area2)<1){Area::created(['name'=>$area->name,'det'=>$sucursal2->det,'id'=>$sucursal2->id,'store'=>$sucursal2->store]);}
            $area2 = Area::all()->where('det','=',$sucursal2->det)->where('name','=',$area->name)->first();
            $modelo2 = Modelo::all()->where('det','=',$sucursal2->det)->where('name','=',$modelo->name);
            if(count($modelo2)<1){Modelo::created(['name'=>$modelo->name,'det'=>$sucursal2->det,'id'=>$area2->id,'store'=>$sucursal2->store]);}
            $modelo2 = Modelo::all()->where('det',$sucursal2->det)->where('name',$modelo->name)->first();            
            $dir = '\\sucursales\\'.Str::slug($sucursal2->namesucu).'\\'. Str::slug($modelo->name).'\\';
            if(!is_dir(public_path($dir))){mkdir(public_path($dir),0755,true);}
            $path2 = 'sucursales\\' . $modelo2->det . '\\' . $modelo2->name . '\\';
            $fileName2 = public_path($path2 . 'scap.zip');
            if(!is_dir($path2)){mkdir($path2,0755,true);}
            $fileName != $fileName2 ? copy($fileName,$fileName2):'';
            $zip2 = new ZipArchive();
            $zip2->open($fileName2);
            switch($modelo->area->first()->name){
                case "Perecederos":
                    if($updateImagenes){
                        $images = $modelo->image;
                        $images2 = count($modelo2->image)>0?$modelo2->image:[];
                        if(count($images)>0){
                            if(count($images2)>count($images)){
                                for($i=count($images);$i<count($images2);$i++){content_audit(Imagen::all()->where('modelo_id','=',$modelo2->id)->last(),"Imagen");Imagen::all()->where('modelo_id','=',$modelo2->id)->last()->delete();}
                            }
                            $js = fopen(public_path($path2.'imagenes.js'), "w+b");
                            fwrite($js, "var imagenes= [");
                            for($i=0;$i<count($images);$i++){
                                if(count($images2)>$i){
                                    fwrite($js, "'".$images->skip($i)->first()->name."'");
                                    $art = $images2->skip($i)->first();
                                    $art->name = $images->skip($i)->first()->name;
                                    $art->url = $images->skip($i)->first()->url;
                                    $art->nombre = Auth::user()->name;
                                    $art->save();
                                }else{
                                    fwrite($js, "'".$images->skip($i)->first()->name."'");
                                    Imagen::created(['name'=>$images->skip($i)->first()->name,'url'=>$images->skip($i)->first()->url,'modelo_id'=>$modelo2->id,'det'=>$request->get('det2'),'modelo'=>$modelo2->name]);
                                }
                                if(!is_dir(public_path('res/imagenes'))){
                                    mkdir(public_path('res/imagenes'),0755,true);
                                }
                                if(is_dir(public_path($path2))){
                                    if(!is_file(public_path('/res/imagenes/'.$art->url))){
                                        is_file(public_path($path2.$art->name))?rename(public_path($path2.$art->url),public_path('res\\imagenes\\'.$art->url)):'';
                                    }
                                }
                                if(($i+1)!=count($images)){fwrite($js, ",");}
                                $zip2->addFile(public_path('/res/imagenes/'.$images->skip($i)->first()->url), $images->skip($i)->first()->name); 
                            }
                            fwrite($js, "];");
                            fclose($js);
                            $zip2->addFile(public_path($path2.'imagenes.js'), 'imagenes.js');
                        }
                    }elseif($type->imagenes){
                        $images2 = count($modelo2->image)>0?$modelo2->image:[];
                        if(!is_dir(public_path('res/imagenes'))){
                            mkdir(public_path('res/imagenes'),0755,true);
                        }
                        if(count($images2)>0){
                            $js = fopen(public_path($path2.'imagenes.js'), "w+b");
                            fwrite($js, "var imagenes= [");
                            foreach($images2 as $img2){
                                fwrite($js, "'".$img2->name."'");
                                if(is_dir(public_path($path2))){
                                    if(!is_file(public_path('/res/imagenes/'.$img2->url))){
                                        is_file(public_path($path2.$img2->name))?rename(public_path($path2.$img2->url),public_path('res\\imagenes\\'.$img2->url)):'';
                                    }
                                }
                                if($images2->last()!=$img2){fwrite($js, ",");}
                                $zip2->addFile(public_path('/res/imagenes/'.$img2->url), $img2->name);
                            }
                            fwrite($js, "];");
                            fclose($js);
                            $zip2->addFile(public_path($path2.'imagenes.js'), 'imagenes.js');
                        }
                    }
                case "Marketside":
                    if($updatePrecios){
                        $lista = Lista::all()->where('modelo_id','=',$modelo->id)->first();
                        $lista2 = Lista::all()->where('det','=',$sucursal2->det)->where('modelo_id','=',$modelo2->id)->sortBy('id');
                        if(count($lista2)<1){
                            Lista::created(['det'=>$sucursal2->det,'url'=>$path2,'modelo_id'=>$modelo2->id,'cantxpage'=>$lista->cantxpage]);
                        }
                        $lista2 = Lista::all()->where('modelo_id',$modelo2->id)->first();
                        $precios = $lista->precio->sortBy('id');
                        $precios2 = $lista2->precio->sortBy('id');
                        if(count($precios2)>count($precios)){
                            for($i=count($precios);$i<count($precios2);$i++){content_audit(Precio::all()->where('modelo_id','=',$modelo2->id)->sortBy('id')->last(),"Precio");Precio::all()->where('modelo_id','=',$modelo2->id)->sortBy('id')->last()->delete();}
                        }
                        for($i=0;$i<count($precios);$i++){
                            if(count(Precio::all()->where('modelo_id','=',$modelo2->id))>$i){
                                $art = Precio::all()->where('modelo_id','=',$modelo2->id)->sortBy('id')->skip($i)->first();
                                $art->name = $precios->skip($i)->first()->name;
                                $art->precio = $precios->skip($i)->first()->precio;
                                $art->centavo = $precios->skip($i)->first()->centavo;
                                $art->nombre = Auth::user()->name;
                                $art->save();
                            }else{Precio::created(['name'=>$precios->skip($i)->first()->name,'precio'=>$precios->skip($i)->first()->precio,'centavo'=>$precios->skip($i)->first()->centavo,'det'=>$sucursal2->det,'modelo_id'=>$modelo2->id,]);}
                        }

                        $extra = $lista->extra->sortBy('id');
                        $extra2 = $lista2->extra->sortBy('id');
                        if(count($extra2)>count($extra)){
                            for($i=count($extra);$i<count($extra2);$i++){content_audit(Extra::all()->where('modelo_id','=',$modelo2->id)->sortBy('id')->last(),"Extra");Extra::all()->where('modelo_id','=',$modelo2->id)->sortBy('id')->last()->delete();}
                        }
                        if(count($extra)>1){
                            if($extra2 != $extra){
                                for($i=0;$i<count($extra);$i++){
                                    if(count(Extra::all()->where('modelo_id','=',$modelo2->id))>$i){
                                        $art = Extra::all()->where('modelo_id','=',$modelo2->id)->sortBy('id')->skip($i)->first();
                                        $art->name = $extra->skip($i)->first()->name;
                                        $art->precio = $extra->skip($i)->first()->precio;
                                        $art->nombre = Auth::user()->name;
                                        $art->save();
                                    }else{Extra::created(['name'=>$extra->skip($i)->first()->name,'precio'=>$extra->skip($i)->first()->precio,'det'=>$sucursal2->det,'modelo_id'=>$modelo2->id]);                        }
                                }
                            }
                        }
                        $lista2->nameFijo1 = $lista->nameFijo1;
                        $lista2->pfijo1 = $lista->pfijo1;
                        $lista2->cfijo1 = $lista->cfijo1;
                        $lista2->nameFijo2 = $lista->nameFijo2;
                        $lista2->pfijo2 = $lista->pfijo2;
                        $lista2->cfijo2 = $lista->cfijo2;
                        $lista2->nombre = Auth::user()->name;
                        $lista2->save();

                        if(!is_dir(public_path($path2))){
                            mkdir(public_path($path2),0755,true);
                        }
                        $js = fopen(public_path($path2 . 'precios.js'), "w+b");
                        // fwrite($js, "var DOWNLOAD_JSON = 'http://digitalsolution.ddns.net:901/Sucursales/".Str::slug($sucursal2->namesucu)."/".Str::slug($modelo->name)."/lista.json';");
                        fwrite($js, "var DOWNLOAD_JSON = 'http://192.168.100.118:8000/Sucursales/".Str::slug($sucursal2->namesucu)."/".Str::slug($modelo->name)."/lista.json';");
                        fclose($js);
                        $zip2->addFile(public_path($path2.'precios.js'), 'precios.js');
                        $cantxpage = tipos_de_modelo::all()->where('name',$modelo->name)->first()->cantxpage;
                        $fecha = (string)Carbon::now()->isoFormat('YMMDD');
                        $hora = (string)Carbon::now()->isoFormat('HHmm'); 
                        $list = fopen(public_path($path2 . "lista.json"), 'w');
                        $cantNormal = count($precios);
                        $cantExtra = count($extra);
                        $page = (string) ($cantNormal>$cantxpage) ? (ceil($cantNormal/$cantxpage)) : '1';
                        fwrite($list,'{' . PHP_EOL . '"fecha":"' . $fecha. '",'. PHP_EOL . '"hora":"' . $hora . '",'. PHP_EOL . '"page":"' . $page . '",'. PHP_EOL);
                        if($cantExtra>0){
                            fwrite($list, '"extra":"' . ($cantExtra>$cantxpage?ceil($cantExtra/$cantxpage):1) . '",' . PHP_EOL);
                        }
                        fwrite($list, '"cantxPage":"' . $cantxpage . '",' . PHP_EOL);
                        if(isset($lista->pfijo1)){
                            fwrite($list,'"pfijo1":"' . $lista->pfijo1 . '",'. PHP_EOL . '"cfijo1":"' . $lista->cfijo1 . '",'. PHP_EOL. '"nameFijo1":"' . $lista->nameFijo1 . '",'. PHP_EOL);
                        }
                        if(isset($lista->pfijo2)){
                            fwrite($list,'"pfijo2":"' . $lista->pfijo2 . '",'. PHP_EOL . '"cfijo2":"' . $lista->cfijo2 . '",'. PHP_EOL. '"nameFijo2":"' . $lista->nameFijo2 . '",'. PHP_EOL);
                        }
                        if($modelo->name != 'Deli U'){
                            fwrite($list,'"paginas":['. PHP_EOL);    
                            $a = 0;
                            $l = $cantNormal/$cantxpage;
                            for($i=0;$i<$l;$i++){
                                fwrite($list, "\t" . '{"hoja":[' . PHP_EOL);
                                for($j=0;$j<$cantxpage;$j++){
                                    fwrite($list, "\t\t" . '{"precio":"' . (isset($precios->skip($a)->first()->precio)?$precios->skip($a)->first()->precio:'') . '","centavo":"' . (isset($precios->skip($a)->first()->centavo)?$precios->skip($a)->first()->centavo:'') . '","producto":"' . (isset($precios->skip($a)->first()->name)?str_replace(",", "&#44;", $precios->skip($a)->first()->name):'') . '"}');
                                    if(($j+1)!=$cantxpage){fwrite($list,',' . PHP_EOL);}else{fwrite($list, PHP_EOL);}
                                    $a++;
                                }
                                if($a>=$cantNormal){
                                    fwrite($list, "\t" . ']}' . PHP_EOL);
                                }else{
                                    fwrite($list, "\t" . ']},' . PHP_EOL);
                                }
                            }
                        }else{
                            $titulo = (object)["deli"=>[],"sandwich"=>[],"ensalada"=>[],"salsas"=>[],"paquetes"=>[]];
                            $deli = Precio::all()->where('modelo_id','=',$modelo->id)->where('centavo','Deli')->sortBy('id');
                            count($deli)>0?$titulo->deli = $deli:'';
                            $sandwich = Precio::all()->where('modelo_id','=',$modelo->id)->where('centavo','sandwich')->sortBy('id');
                            count($sandwich)>0?$titulo->sandwich = $sandwich:'';
                            $ensalada = Precio::all()->where('modelo_id','=',$modelo->id)->where('centavo','ensalada')->sortBy('id');
                            count($ensalada)>0?$titulo->ensalada = $ensalada:'';
                            $salsas =  Precio::all()->where('modelo_id','=',$modelo->id)->where('centavo','salsas')->sortBy('id');
                            count($salsas)>0?$titulo->salsas = $salsas:'';
                            $paquetes = Precio::all()->where('modelo_id','=',$modelo->id)->where('centavo','paquetes')->sortBy('id');
                            count($paquetes)>0?$titulo->paquetes = $paquetes:'';
                            $z = 0;
                            foreach($titulo as $t => $v){
                                fwrite($list, '"'.$t.'":['. PHP_EOL);
                                $a = 0;
                                for($i=0;$i<(count($titulo->$t)/$cantxpage);$i++){
                                    fwrite($list, "\t\t" . '{"hoja":[' . PHP_EOL);
                                    for($j=0;$j<$cantxpage;$j++){
                                        fwrite($list, "\t\t\t" . '{"precio":"' . $v->skip($a)->first()->precio . '","producto":"' . str_replace(",", "&#44;", $v->skip($a)->first()->name) . '"}');
                                        $a++;
                                        if(count($v)<=$a){
                                            fwrite($list, PHP_EOL);
                                            break;
                                        }else{
                                            if(($j+1)!=$cantxpage){fwrite($list,',' . PHP_EOL);}else{fwrite($list, PHP_EOL);}
                                        }
                                    }
                                    if($a>=count($titulo->$t)){
                                        fwrite($list, "\t\t" . ']}' . PHP_EOL);
                                    }else{
                                        fwrite($list, "\t\t" . ']},' . PHP_EOL);
                                    }
                                }
                                if(4>$z){
                                    fwrite($list, "\t" . '],' . PHP_EOL);
                                    $z++;
                                }else{
                                    fwrite($list, "\t" . ']' . PHP_EOL);
                                }
                            }
                        }
                        $pageExtra = (string) ($cantExtra>$cantxpage) ? (ceil($cantExtra/$cantxpage)) : '1';
                        if($cantExtra>0){
                            fwrite($list,'],'. PHP_EOL);
                            fwrite($list,'"plus":['. PHP_EOL);
                            $a = 0;
                            for($i=0;$i<$pageExtra;$i++){
                                fwrite($list, "\t" . '{"hoja":[' . PHP_EOL);
                                for($j=0;$j<$cantxpage;$j++){
                                    fwrite($list, "\t\t" . '{"precio":"' . (isset($extra->skip($a)->first()->precio)?$extra->skip($a)->first()->precio:'') . '","centavo":"","producto":"' . (isset($extra->skip($a)->first()->name)?$extra->skip($a)->first()->name:'') . '"}');
                                    if(($j+1)!=$cantxpage){fwrite($list,',' . PHP_EOL);}else{fwrite($list, PHP_EOL);}
                                    $a++;
                                }
                                if($a>=$cantExtra){
                                    fwrite($list, "\t" . ']}' . PHP_EOL);
                                }else{
                                    fwrite($list, "\t" . ']},' . PHP_EOL);
                                }
                            }
                        }
                        if($modelo->name != 'Deli U'){fwrite($list, ']}');}else{fwrite($list, '}');};
                        fclose($list);
                        
                        if($area2->name == 'Perecederos' || $area2->name =='Marketside'){
                            if(is_file(public_path( $path2 .'lista.json'))){
                                if(copy(public_path( $path2 . 'lista.json'),public_path( $dir .'lista.json'))){
                                }else{return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('error','Fallo al actualizar la lista de precios, intente nuevamente');}
                            }else{return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('error','Fallo al validar la lista de precios, pruebe crear una lista e intente nuevamente');}
                        }
                        $zip2->addFile(public_path($path2."lista.json"), "lista.json");
                    }elseif($type->precios){
                        $lista2 = Lista::all()->where('modelo_id',$modelo2->id)->first();
                        $precios2 = $lista2->precio->sortBy('id');
                        $extra2 = $lista2->extra->sortBy('id');
                        if(!is_dir(public_path($path2))){mkdir(public_path($path2),0755,true);}
                        $js = fopen(public_path($path2 . 'precios.js'), "w+b");
                        // fwrite($js, "var DOWNLOAD_JSON = 'http://digitalsolution.ddns.net:901/Sucursales/".Str::slug($sucursal2->namesucu)."/".Str::slug($modelo->name)."/lista.json';");
                        fwrite($js, "var DOWNLOAD_JSON = 'http://192.168.100.118:8000/Sucursales/".Str::slug($sucursal2->namesucu)."/".Str::slug($modelo->name)."/lista.json';");
                        fclose($js);
                        $zip2->addFile(public_path($path2.'precios.js'), 'precios.js');
                        $cantxpage = tipos_de_modelo::all()->where('name',$modelo->name)->first()->cantxpage;
                        $fecha = (string)Carbon::now()->isoFormat('YMMDD');
                        $hora = (string)Carbon::now()->isoFormat('HHmm'); 
                        $list = fopen(public_path($path2 . "lista.json"), 'w');
                        $cantNormal = count($precios2);
                        $cantExtra = count($extra2);
                        $page = (string) ($cantNormal>$cantxpage) ? (ceil($cantNormal/$cantxpage)) : '1';
                        fwrite($list,'{' . PHP_EOL . '"fecha":"' . $fecha. '",'. PHP_EOL . '"hora":"' . $hora . '",'. PHP_EOL . '"page":"' . $page . '",'. PHP_EOL);
                        if($cantExtra>0){
                            fwrite($list, '"extra":"' . ($cantExtra>$cantxpage?ceil($cantExtra/$cantxpage):1) . '",' . PHP_EOL);
                        }
                        fwrite($list, '"cantxPage":"' . $cantxpage . '",' . PHP_EOL);
                        if(isset($lista2->pfijo1)){
                            fwrite($list,'"pfijo1":"' . $lista2->pfijo1 . '",'. PHP_EOL . '"cfijo1":"' . $lista2->cfijo1 . '",'. PHP_EOL. '"nameFijo1":"' . $lista2->nameFijo1 . '",'. PHP_EOL);
                        }
                        if(isset($lista2->pfijo2)){
                            fwrite($list,'"pfijo2":"' . $lista2->pfijo2 . '",'. PHP_EOL . '"cfijo2":"' . $lista2->cfijo2 . '",'. PHP_EOL. '"nameFijo2":"' . $lista2->nameFijo2 . '",'. PHP_EOL);
                        }
                        if($modelo->name != 'Deli U'){
                            fwrite($list,'"paginas":['. PHP_EOL);    
                            $a = 0;
                            for($i=0;$i<($cantNormal/$cantxpage);$i++){
                                fwrite($list, "\t" . '{"hoja":[' . PHP_EOL);
                                for($j=0;$j<$cantxpage;$j++){
                                    fwrite($list, "\t\t" . '{"precio":"' . 
                                        (isset($precios2->skip($a)->first()->precio)?$precios2->skip($a)->first()->precio:'') . '","centavo":"' . 
                                        (isset($precios2->skip($a)->first()->centavo)?$precios2->skip($a)->first()->centavo:'') . '","producto":"' . 
                                        (isset($precios2->skip($a)->first()->name)?str_replace(",", "&#44;", $precios2->skip($a)->first()->name):'') . '"}');
                                    if(($j+1)!=$cantxpage){fwrite($list,',' . PHP_EOL);}else{fwrite($list, PHP_EOL);}
                                    $a++;
                                }
                                if($a>=$cantNormal){
                                    fwrite($list, "\t" . ']}' . PHP_EOL);
                                }else{
                                    fwrite($list, "\t" . ']},' . PHP_EOL);
                                }
                            }
                        }else{
                            $titulo = (object)["deli"=>[],"sandwich"=>[],"ensalada"=>[],"salsas"=>[],"paquetes"=>[]];
                            $deli = Precio::all()->where('modelo_id','=',$modelo2->id)->where('centavo','Deli')->sortBy('id');
                            count($deli)>0?$titulo->deli = $deli:'';
                            $sandwich = Precio::all()->where('modelo_id','=',$modelo2->id)->where('centavo','sandwich')->sortBy('id');
                            count($sandwich)>0?$titulo->sandwich = $sandwich:'';
                            $ensalada = Precio::all()->where('modelo_id','=',$modelo2->id)->where('centavo','ensalada')->sortBy('id');
                            count($ensalada)>0?$titulo->ensalada = $ensalada:'';
                            $salsas =  Precio::all()->where('modelo_id','=',$modelo2->id)->where('centavo','salsas')->sortBy('id');
                            count($salsas)>0?$titulo->salsas = $salsas:'';
                            $paquetes = Precio::all()->where('modelo_id','=',$modelo2->id)->where('centavo','paquetes')->sortBy('id');
                            count($paquetes)>0?$titulo->paquetes = $paquetes:'';
                            $z = 0;
                            foreach($titulo as $t => $v){
                                fwrite($list, '"'.$t.'":['. PHP_EOL);
                                $a = 0;
                                for($i=0;$i<(count($titulo->$t)/$cantxpage);$i++){
                                    fwrite($list, "\t\t" . '{"hoja":[' . PHP_EOL);
                                    for($j=0;$j<$cantxpage;$j++){
                                        fwrite($list, "\t\t\t" . '{"precio":"' . $v->skip($a)->first()->precio . '","producto":"' . str_replace(",", "&#44;", $v->skip($a)->first()->name) . '"}');
                                        $a++;
                                        if(count($v)<=$a){
                                            fwrite($list, PHP_EOL);
                                            break;
                                        }else{
                                            if(($j+1)!=$cantxpage){fwrite($list,',' . PHP_EOL);}else{fwrite($list, PHP_EOL);}
                                        }
                                    }
                                    if($a>=count($titulo->$t)){
                                        fwrite($list, "\t\t" . ']}' . PHP_EOL);
                                    }else{
                                        fwrite($list, "\t\t" . ']},' . PHP_EOL);
                                    }
                                }
                                if(4>$z){
                                    fwrite($list, "\t" . '],' . PHP_EOL);
                                    $z++;
                                }else{
                                    fwrite($list, "\t" . ']' . PHP_EOL);
                                }
                            }
                        }
                        $pageExtra = (string) ($cantExtra>$cantxpage) ? (ceil($cantExtra/$cantxpage)) : '1';
                        if($cantExtra>0){
                            fwrite($list,'],'. PHP_EOL);
                            fwrite($list,'"plus":['. PHP_EOL);
                            $a = 0;
                            for($i=0;$i<$pageExtra;$i++){
                                fwrite($list, "\t" . '{"hoja":[' . PHP_EOL);
                                for($j=0;$j<$cantxpage;$j++){
                                    fwrite($list, "\t\t" . '{"precio":"' . (isset($extra2->skip($a)->first()->precio)?$extra2->skip($a)->first()->precio:'') . '","centavo":"","producto":"' . (isset($extra2->skip($a)->first()->name)?$extra2->skip($a)->first()->name:'') . '"}');
                                    if(($j+1)!=$cantxpage){fwrite($list,',' . PHP_EOL);}else{fwrite($list, PHP_EOL);}
                                    $a++;
                                }
                                if($a>=$cantExtra){
                                    fwrite($list, "\t" . ']}' . PHP_EOL);
                                }else{
                                    fwrite($list, "\t" . ']},' . PHP_EOL);
                                }
                            }
                        }
                        if($modelo2->name != 'Deli U'){fwrite($list, ']}');}else{fwrite($list, '}');};
                        fclose($list);
                        if($area2->name == 'Perecederos' || $area2->name =='Marketside'){
                            if(is_file(public_path( $path2 .'lista.json'))){
                                if(copy(public_path( $path2 . 'lista.json'),public_path( $dir .'lista.json'))){
                                }else{return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('error','Fallo al actualizar la lista de precios, intente nuevamente');}
                            }else{return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('error','Fallo al validar la lista de precios, pruebe crear una lista e intente nuevamente');}
                        }
                        $zip2->addFile(public_path($path2."lista.json"), "lista.json");
                    }
                case "Video Wall":
                case "Default":
                case "Ultra Strech":
                case "Meses sin Intereses":
                    if($updateVideos && $type->videos){
                        $jsUrl = public_path($path2);
                        $vUrl = public_path('res\\videos\\');
                        !is_dir($jsUrl)?mkdir($jsUrl,0755,true):'';
                        !is_dir($vUrl)?mkdir($vUrl,0755,true):'';
                        $position = Video::select('id','name','url','det','validity','updated_at','nombre')->where('modelo_id',$request->get('id'))->orderBy('id')->get();
                        $videos = Video::select('id','name','url','det','validity','updated_at','nombre')->where('modelo_id',$modelo2->id)->orderBy('id')->get();
                        if(count($position)!=0){
                            if(count($videos) > count($position)){
                                for($i=0;count($position)<count($videos);$i++){
                                    content_audit($videos->last(),'Video');
                                    $videos->last()->delete();
                                    $videos = Video::select('id','name','url','det','validity','updated_at','nombre')->where('modelo_id',$modelo2->id)->orderBy('id')->get();
                                }
                            }
                            $list = fopen(public_path($path2."appinfo.json"), 'w+');
                            fwrite($list, '{'. PHP_EOL . "\t");
                            foreach($position as $key => $pos){
                                $ext = substr($pos->url, -4);
                                $vid = $videos->sortBy('id')->skip($key)->first();
                                if($vid){
                                    $vid->url = $pos->url;
                                    $vid->name = $key . $ext;
                                    $vid->validity = $pos->validity ?? '';
                                    $vid->det = $modelo2->det;
                                    $vid->nombre = Auth::user()->name;
                                    $vid->save();
                                }else{
                                    Video::created(['name'=>$key . $ext,'url'=>$pos->url,'modelo_id'=>$modelo->id,'det'=>$modelo->det,'vigencia'=>$pos->validity,'modelo'=>$modelo->name,'nombre'=>Auth::user()->name]);
                                }
                                if(!is_file(public_path('/res/videos/'.$pos->url))){
                                    is_file(public_path($path2 . $key . $ext))?rename(public_path($path2 . $key . $ext),public_path('res\\videos\\'.$pos->url)):'';
                                }
                                fwrite($list,'"'. $key . $ext .'":"' . $pos->validity . '",' . PHP_EOL . "\t");
                                $zip2->addFile(public_path('/res/videos/'.$pos->url), $key . $ext); 
                            }
                            fwrite($list,'"videos":"' . count($position) . '",' . PHP_EOL. "\t" .'"version": "' . ($modelo2->v_template ?? 0) . '.'. ($modelo2->v_update+1) .'"'. PHP_EOL.'}');
                            fclose($list);
                            $zip2->addFile(public_path($path2."appinfo.json"), "appinfo.json");
                            $js = fopen(public_path($path2.'video.js'), "w+b");
                            fwrite($js, "function playlist(){". PHP_EOL ."\tvar gapless = new GaplessPlayback('gaplessPlayer', 'gaplessPlaylist');". PHP_EOL ."\tgapless.setContentPath('ipk');". PHP_EOL);
                            for($i=0;$i<count($position);$i++){
                                fwrite($js, "\tgapless.addContent('".$i.".mp4', 500);". PHP_EOL);
                            }
                            fwrite($js, "\tgapless.setObjectFit('fill');". PHP_EOL ."\tgapless.play();". PHP_EOL ."}");
                            fclose($js);
                            $zip2->addFile(public_path($path2.'video.js'), 'video.js');
                        }else{
                            return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('error',["Video"=>'Error no hay videos que enviar']);
                        }
                    }elseif($type->videos){
                        $jsUrl = public_path($path2);
                        $vUrl = public_path('res\\videos\\');
                        !is_dir($jsUrl)?mkdir($jsUrl,0755,true):'';
                        !is_dir($vUrl)?mkdir($vUrl,0755,true):'';
                        $videos = Video::select('id','name','url','det','validity','updated_at','nombre')->where('modelo_id',$modelo2->id)->orderBy('id')->get();
                        if(!is_file(public_path($path2."appinfo.json"))){
                            $list = fopen(public_path($path2."appinfo.json"), 'w+');
                            fwrite($list, '{'. PHP_EOL . "\t");
                            foreach($videos as $key => $pos){
                                $ext = substr($pos->url, -4);
                                if(!is_file(public_path('/res/videos/'.$pos->url))){
                                    is_file(public_path($path2 . $key . $ext))?rename(public_path($path2 . $key . $ext),public_path('res\\videos\\'.$pos->url)):'';
                                }
                                fwrite($list,'"'. $key . $ext .'":"' . $pos->validity . '",' . PHP_EOL . "\t");
                                $zip2->addFile(public_path('/res/videos/'.$pos->url), $key . $ext); 
                            }
                            fwrite($list,'"videos":"' . count($videos) . '",' . PHP_EOL. "\t" .'"version": "' . ($modelo2->v_template ?? 0) . '.'. ($modelo2->v_update+1) .'"'. PHP_EOL.'}');
                            fclose($list);
                        }else{
                            foreach($videos as $key => $pos){
                                $ext = substr($pos->url, -4);
                                if(!is_file(public_path('/res/videos/'.$pos->url))){
                                    is_file(public_path($path2 . $key . $ext))?rename(public_path($path2 . $key . $ext),public_path('res\\videos\\'.$pos->url)):'';
                                }
                                $zip2->addFile(public_path('/res/videos/'.$pos->url), $key . $ext); 
                            }
                        }
                        $zip2->addFile(public_path($path2."appinfo.json"), "appinfo.json");
                        $js = fopen(public_path($path2.'video.js'), "w+b");
                        fwrite($js, "function playlist(){". PHP_EOL ."\tvar gapless = new GaplessPlayback('gaplessPlayer', 'gaplessPlaylist');". PHP_EOL ."\tgapless.setContentPath('ipk');". PHP_EOL);
                        for($i=0;$i<count($videos);$i++){
                            fwrite($js, "\tgapless.addContent('".$i.".mp4', 500);". PHP_EOL);
                        }
                        fwrite($js, "\tgapless.setObjectFit('fill');". PHP_EOL ."\tgapless.play();". PHP_EOL ."}");
                        fclose($js);
                        $zip2->addFile(public_path($path2.'video.js'), 'video.js');
                    }
                break;    
            }
            $zip2->close();
            $size =filesize($fileName2);
            copy(public_path($path2.'scap.zip'),public_path($dir . 'scap.zip'));
            $list = fopen(public_path($dir . 'appinfo.json'), 'w+');
            fwrite($list, '{'. PHP_EOL . "\t" .'"vendor": "Digital Solution",' . PHP_EOL .  "\t" .'"icon": "icon.png",' . PHP_EOL . "\t" . '"main": "index.html",'. PHP_EOL . "\t" .'"id": "com.lg.app.signage",'. PHP_EOL . "\t" .'"inspectable":true,'. PHP_EOL . "\t" . '"title":"'. $modelo2->name .'",' . PHP_EOL . "\t" . '"type": "web",' . PHP_EOL . "\t" . '"version": "' . ($modelo2->v_template ?? 0) . '.'. ($modelo2->v_update+1) .'",'. PHP_EOL . "\t" .'"size":'. $size . PHP_EOL .'}');
            fclose($list);
            $modelo3 = Modelo::find($modelo2->id);
            $modelo3->tipo = request('contentUpdate');
            $modelo3->v_update = (string)((integer)$modelo2->v_update + 1);
            $modelo3->nombre = Auth::user()->name;
            $modelo3->save();
            is_file(public_path($path2.'scap.zip'))?unlink(public_path($path2.'scap.zip')):'';
        }
        is_file(public_path($path.'scap.zip'))?unlink(public_path($path.'scap.zip')):'';
        
        return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('success', 'Actualizacion completa, reinicie la pantalla para comenzar la descarga');
    }
}
