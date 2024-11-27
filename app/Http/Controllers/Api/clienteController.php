<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class clienteController extends Controller
{
    public function index(){
        $clientes = Cliente::all();

        if($clientes->isEmpty()){
            $data = [
                "message"=> "No hay clientes registrados",
                "status"=> 200
            ];
            return response()->json( $data, 200 );
        }

        $data = [
            "clientes" => $clientes,
            "status" => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|max:255",
            "apellidos" => "required|string|max:255",
            "fecha_registro" => "required|date",
            "numero_telefonico" => "required|digits:10",
            "correo_electronico" => "required|email|max:255",
            "contrasena" => "required|string|min:8"
        ]);

        if($validator->fails()){
            $data = [
                "message"=> "Error en la validación de los datos",
                "errores"=> $validator->errors(),
                "status"=> 400
            ];
            return response()->json( $data, 400);
        }
        
        $cliente = Cliente::create([
            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "fecha_registro" => $request->fecha_registro,
            "numero_telefonico" => $request->numero_telefonico,
            "correo_electronico" => $request->correo_electronico,
            "contrasena" => $request->contrasena
        ]);

        if(!$cliente){
            $data = [
                "message"=> "Error al crear al cliente",
                "status"=> 500
            ];
            return response()->json( $data, 500);
        }

        $data = [
            "cliente" => $cliente,
            "status" => 201
        ];
        return response()->json( $data, 201);
    }

    public function show($id){
        $cliente = Cliente::find($id);
        if(!$cliente){
            $data = [
                "message"=> "Error al encontrar al cliente",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $data = [
            "cliente" => $cliente,
            "status" => 200
        ];
        return response()->json( $data, 200);
    }

    public function destroy($id){  
        $cliente = Cliente::find($id);
        if(!$cliente){
            $data = [
                "message"=> "Error al encontrar al cliente",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }
        $cliente->delete();

        $data = [
            "message"=> "Cliente eliminado correctamente",
            "status"=> 200
        ];
        return response()->json( $data, 200);
    }

    public function update(Request $request, $id){
        $cliente = Cliente::find($id);
        if(!$cliente){
            $data = [
                "message"=> "Error al encontrar al cliente",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|max:255",
            "apellidos" => "required|string|max:255",
            "fecha_registro" => "required|date",
            "numero_telefonico" => "required|digits:10",
            "correo_electronico" => "required|email|max:255",
            "contrasena" => "required|string|min:8"
        ]);

        if($validator->fails()){
            $data = [
                "message"=> "Error en la validación de los datos",
                "errores"=> $validator->errors(),
                "status"=> 400
            ];
            return response()->json( $data, 400);
        }

        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->fecha_registro = $request->fecha_registro;
        $cliente->numero_telefonico = $request->numero_telefonico;
        $cliente->correo_electronico = $request->correo_electronico;
        $cliente->contrasena = $request->contrasena;

        $cliente -> save();

        $data = [
            "message" => "Datos de el cliente actualizados correctamente",
            "cliente" => $cliente,
            "status" => 201
        ];
        return response()->json( $data, 201);
    }
}
