<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tarea::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $inputs = $request->input();
        $tarea = Tarea::create($inputs);
        return response()->json([
            'data' => $tarea,
            'mensaje' => "Creado con exito",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id){
        $tarea = Tarea::find($id);
        if(isset($tarea)){
            return response()->json([
                'data' => $tarea,
                'mensaje' => "Encontrado con exito",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No se encontro",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tarea = Tarea::find($id);
        if (isset($tarea)) {
            $tarea->nombre = $request->nombre;
            $tarea->descripcion = $request->descripcion;
            $tarea->estado = $request->estado;

            if ($tarea->save()) {
                return response()->json([
                    'data' => $tarea,
                    'mensaje' => "Actualizado con exito",
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "No Se actualizo",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $tarea = Tarea::find($id);
        if(isset($tarea)){
            $res = Tarea::destroy($id);
            if($res){
                return response()->json([
                    'data' => $tarea,
                    'mensaje' => "Eliminado con exito",
                ]);
            }else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "No existe",
                ]);
            }
        }else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe",
            ]);
        } 
       
    
}
}