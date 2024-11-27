<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class usuarioController extends Controller
{
    public function index(){
        $usuarios = Usuario::all();

        if($usuarios->isEmpty()){
            $data = [
                "message"=> "No hay usuarios registrados",
                "status"=> 200
            ];
            return response()->json( $data, 200 );
        }

        $data = [
            "usuarios" => $usuarios,
            "status" => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|max:255",
            "apellidos" => "required|string|max:255",
            "correo_electronico" => "required|email|max:255",
            "contrasena" => "required|string|min:8",
            "fecha_registro" => "required|date",
            "rol" => "required|string|max:255",
        ]);

        if($validator->fails()){
            $data = [
                "message"=> "Error en la validación de los datos",
                "errores"=> $validator->errors(),
                "status"=> 400
            ];
            return response()->json( $data, 400);
        }
        
        $usuario = Usuario::create([
            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "correo_electronico" => $request->correo_electronico,
            "contrasena" => $request->contrasena,
            "fecha_registro" => $request->fecha_registro,
            "rol" => $request->rol
        ]);

        if(!$usuario){
            $data = [
                "message"=> "Error al crear al usuario",
                "status"=> 500
            ];
            return response()->json( $data, 500);
        }

        $data = [
            "usuario" => $usuario,
            "status" => 201
        ];
        return response()->json( $data, 201);
    }

    public function show($id){
        $usuario = Usuario::find($id);
        if(!$usuario){
            $data = [
                "message"=> "Error al encontrar al usuario",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $data = [
            "usuario" => $usuario,
            "status" => 200
        ];
        return response()->json( $data, 200);
    }

    public function destroy($id){  
        $usuario = Usuario::find($id);
        if(!$usuario){
            $data = [
                "message"=> "Error al encontrar al usuario",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }
        $usuario->delete();

        $data = [
            "message"=> "Usuario eliminado correctamente",
            "status"=> 200
        ];
        return response()->json( $data, 200);
    }

    public function update(Request $request, $id){
        $usuario = Usuario::find($id);
        if(!$usuario){
            $data = [
                "message"=> "Error al encontrar al usuario",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $validator = Validator::make($request->all(), [
            "nombre" => "required|string|max:255",
            "apellidos" => "required|string|max:255",
            "correo_electronico" => "required|email|max:255",
            "contrasena" => "required|string|min:8",
            "fecha_registro" => "required|date",
            "rol" => "required|string|max:255",
        ]);

        if($validator->fails()){
            $data = [
                "message"=> "Error en la validación de los datos",
                "errores"=> $validator->errors(),
                "status"=> 400
            ];
            return response()->json( $data, 400);
        }

        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->contrasena = $request->contrasena;
        $usuario->fecha_registro = $request->fecha_registro;
        $usuario->rol = $request->rol;

        $usuario -> save();

        $data = [
            "message" => "Datos de el usuario actualizados correctamente",
            "usuario" => $usuario,
            "status" => 201
        ];
        return response()->json( $data, 201);
    }
}
