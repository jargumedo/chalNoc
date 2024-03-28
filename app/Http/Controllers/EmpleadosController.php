<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use Illuminate\Support\Facades\Hash;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmpleadosController extends Controller{
    /** 
    @return Illuminate\Http\Response
    **/

    public function index(){
        return Empleado::all();
    }

    

    public function store(Request $request){
        
        $inputs = $request ->input();
        $inputs ["password"]=Hash::make(trim($request->password));
        $e = Empleado::create($inputs);
        Mail::to($e)->send(new HelloMail());
      
        return response()->json([
            "data"=>$e,
            "mensaje"=>"Empleado actualizado con exito"

        ]);
        
        
        

        
        
    }

    public function update(Request $request, $id){
        $e = Empleado::find($id);
       if(isset($e)){
        $e->nombre = $request->nombre;
        $e->apellido = $request->apellido;
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

    public function show($id){
        $e = Empleado::find($id);
        if(isset($e)){
            return response()->json([
                "data"=>$e,
                "mensaje"=>"Empleado encontrado con exito"
            ]);
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"No se encontro el registro"
            ]);
        }
    }
    public function destroy($id){
        $e = Empleado::find($id);
        if(isset($e)){
            $res=Empleado::destroy($id);
            if($res){
                return response()->json([
                    "data"=>$e,
                    "mensaje"=>"Empleado eliminado con exito"
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