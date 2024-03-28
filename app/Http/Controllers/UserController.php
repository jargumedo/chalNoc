<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request ->input();
        $inputs [ "password" ]= Hash::make(trim($request -> password));
        $e = User::create($inputs);
        return response()->json([
            "data"=>$e,
            "mensaje"=>"Usuario registrado con exito"

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $e = User::find($id);
        if(isset($e)){
            return response()->json([
                "data"=>$e,
                "mensaje"=>"Encontrado con exito"
            ]);
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"No se encontro el registro"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = User::find($id);
       if(isset($e)){
        $e->first_name = $request->first_name;
        $e->last_name = $request->last_name;
        $e->email = $request->email;
        $e->password =Hash::make( $request->password);
        if($e->save()){
            return response()->json([
                "data"=>$e,
                "mensaje"=>"Empleado actualizado con exito"
    
            ]);
        }
       }else{
        return response()->json([
            "error"=>true,
            "message"=>"No se encontro el registro"

        ]);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $e = User::find($id);
        if(isset($e)){
            $res=User::destroy($id);
            if($res){
                return response()->json([
                    "data"=>$e,
                    "mensaje"=>"Eliminado con exito"
                ]);
            }else{
                return response()->json([
                    "error"=>true,
                    "message"=>"No se encontro el registro"
                ]);
            }
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"No se encontro el registro"
            ]);
        }
    }
}
