<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class IpkController extends Controller
{

    public function FileUploadPost(Request $request){
        if ($request->logo){
            $validated = $request->validate(['logo' => 'nullable|mimes:jpg,jpeg,png']);
            $image = $validated['logo']->store('public');
        }
        /*
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,ipk',
           ]);
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/ipk');
*/
        return Redirect::route('modelo',['modelo'=>$modelo->slug])->with('success','se guardaron los cambios');
    }
}