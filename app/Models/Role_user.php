<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    use HasFactory;
    protected $table = "role_user";

    public static function created($request)
    {
        $role = new Role_user   ;
        $role->user_id = $request['user_id'];
        $role->role_id = $request['role_id'];
        $role->nombre = Auth::user()->name;
        $role->save();
    }

    public function user(){

    	return $this->belongsTo(User::class);

    }
    public function role(){

    	return $this->belongsTo(Role::class);

    }
}
