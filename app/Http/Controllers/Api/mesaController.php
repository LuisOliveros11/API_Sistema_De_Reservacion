<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class mesaController extends Controller
{
    public function index(){
        $mesas = Mesa::all();

        if($mesas->isEmpty()){
            $data = [
                "message"=> "No hay mesas registradas",
                "status"=> 200
            ];
            return response()->json( $data, 200 );
        }

        $data = [
            "mesas" => $mesas,
            "status" => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "numero" => "required|integer|unique:mesa",
            "cantidad_sillas" => "required|integer",
            "categoria" => "required",
            "ubicacion" => "required",
            "disponibilidad" => "required|string"
        ]);

        if($validator->fails()){
            $data = [
                "message"=> "Error en la validación de los datos",
                "errores"=> $validator->errors(),
                "status"=> 400
            ];
            return response()->json( $data, 400);
        }
        
        $mesa = Mesa::create([
            "numero" => $request->numero,
            "cantidad_sillas" => $request->cantidad_sillas,
            "categoria" => $request->categoria,
            "ubicacion" => $request->ubicacion,
            "disponibilidad" => $request->disponibilidad,
        ]);

        if(!$mesa){
            $data = [
                "message"=> "Error al crear mesa",
                "status"=> 500
            ];
            return response()->json( $data, 500);
        }

        $data = [
            "mesa" => $mesa,
            "status" => 201
        ];
        return response()->json( $data, 201);
    }

    public function show($id){
        $mesa = Mesa::find($id);
        if(!$mesa){
            $data = [
                "message"=> "Error al encontrar la mesa",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $data = [
            "mesa" => $mesa,
            "status" => 200
        ];
        return response()->json( $data, 200);
    }

    public function destroy($id){  
        $mesa = Mesa::find($id);
        if(!$mesa){
            $data = [
                "message"=> "Error al encontrar la mesa",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }
        $mesa->delete();

        $data = [
            "message"=> "Mesa eliminada correctamente",
            "status"=> 200
        ];
        return response()->json( $data, 200);
    }

    public function update(Request $request, $id){
        $mesa = Mesa::find($id);
        if(!$mesa){
            $data = [
                "message"=> "Error al encontrar la mesa",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $validator = Validator::make($request->all(), [
            "numero" => "required|integer",
            "cantidad_sillas" => "required|integer",
            "categoria" => "required",
            "ubicacion" => "required",
            "disponibilidad" => "required|string"
        ]);

        if($validator->fails()){
            $data = [
                "message"=> "Error en la validación de los datos",
                "errores"=> $validator->errors(),
                "status"=> 400
            ];
            return response()->json( $data, 400);
        }

        $mesa->numero = $request->numero;
        $mesa->cantidad_sillas = $request->cantidad_sillas;
        $mesa->categoria = $request->categoria;
        $mesa->ubicacion = $request->ubicacion;
        $mesa->disponibilidad = $request->disponibilidad;

        $mesa -> save();

        $data = [
            "message" => "Datos de la mesa actualizados correctamente",
            "mesa" => $mesa,
            "status" => 201
        ];
        return response()->json( $data, 201);
    }
}
