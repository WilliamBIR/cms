<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if (! function_exists('filtro')) {
    function filtro($collection)
    {
        $filtro =[];
        foreach ($collection as $c){
            array_push($filtro, $c->name);
        }
        return $filtro;
    }
}

function content_audit($request,$tipo){
    if($tipo=='Video')
        DB::table('delete_content_audits')->insert(['usuario'=>Auth::user()->name,'tabla'=>$tipo,'modelo_id'=>$request->modelo_id,'det'=>$request->det,'nombre'=>$request->name,'valor'=>$request->url,'vigencia'=>$request->validity,'created_at'=>now()]);
    else if($tipo=='Precio')
        DB::table('delete_content_audits')->insert(['usuario'=>Auth::user()->name,'tabla'=>$tipo,'modelo_id'=>$request->modelo_id,'det'=>$request->det,'nombre'=>$request->name,'valor'=>$request->precio.'.'.$request->centavo,'vigencia'=>'','created_at'=>now()]);
    else
        DB::table('delete_content_audits')->insert(['usuario'=>Auth::user()->name,'tabla'=>$tipo,'modelo_id'=>$request->modelo_id,'det'=>$request->det,'nombre'=>$request->name,'valor'=>$request->url,'vigencia'=>'','created_at'=>now()]);
}

function stores_audit($request,$tipo){
    if($tipo=='Sucursal')
        DB::table('stores_audits')->insert(['operacion'=>'Delete','usuario'=>Auth::user()->name,'tabla'=>$tipo,'nombre'=>$request->namesucu,'det'=>$request->det,'tienda'=>$request->store,'created_at'=>now()]);
    else
        DB::table('stores_audits')->insert(['operacion'=>'Delete','usuario'=>Auth::user()->name,'tabla'=>$tipo,'nombre'=>$request->name,'det'=>isset($request->det)?$request->det:'','tienda'=>$request->store,'created_at'=>now()]);
}

function user_audit($request){
    DB::table('delete_user_audits')->insert(['usuario'=>Auth::user()->name,'name'=>$request->name,'email'=>$request->email,'password'=>$request->password,'created_at'=>now()]);
}