<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservacion;
use App\Models\Cliente;
use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class reservacionController extends Controller
{
    public function index(){
        $reservaciones = Reservacion::all();

        if($reservaciones->isEmpty()){
            $data = [
                "message"=> "No hay reservaciones registradas",
                "status"=> 200
            ];
            return response()->json( $data, 200 );
        }

        $data = [
            "reservaciones" => $reservaciones,
            "status" => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "fecha_reservacion" => "required|date",
            "correo_electronico" => "required|email|max:255",
            "hora_inicio" => "required|date_format:H:i:s",
            "hora_final" => "required|date_format:H:i:s|after:hora_inicio",
            "numero_mesa" => "required|integer"
        ]);

        if($validator->fails()){
            $data = [
                "message"=> "Error en la validación de los datos",
                "errores"=> $validator->errors(),
                "status"=> 400
            ];
            return response()->json( $data, 400);
        }

        $id_cliente = Cliente::where('correo_electronico', $request->correo_electronico)->value('id');
        if(!$id_cliente){
            $data = [
                "message"=> "Error al encontrar el id_cliente del cliente",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $num_mesa = Mesa::where("numero", $request->numero_mesa)->first();
        if(!$num_mesa){
            $data = [
                "message"=> "Error al encontrar el numero de la mesa",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }
        
        $reservacion = Reservacion::create([
            "fecha_reservacion" => $request->fecha_reservacion,
            "id_cliente" => $id_cliente,
            "hora_inicio" => $request->hora_inicio,
            "hora_final" => $request->hora_final,
            "numero_mesa" => $request->numero_mesa,
        ]);

        if(!$reservacion){
            $data = [
                "message"=> "Error al crear reservacion",
                "status"=> 500
            ];
            return response()->json( $data, 500);
        }

        $data = [
            "reservacion" => $reservacion,
            "status" => 201
        ];
        return response()->json( $data, 201);
    }

    public function show($id){
        $reservacion = Reservacion::find($id);
        if(!$reservacion){
            $data = [
                "message"=> "Error al encontrar la reservacion",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $data = [
            "reservacion" => $reservacion,
            "status" => 200
        ];
        return response()->json( $data, 200);
    }

    public function destroy($id){  
        $reservacion = Reservacion::find($id);
        if(!$reservacion){
            $data = [
                "message"=> "Error al encontrar la reservacion",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }
        $reservacion->delete();

        $data = [
            "message"=> "Reservacion eliminada correctamente",
            "status"=> 200
        ];
        return response()->json( $data, 200);
    }

    public function update(Request $request, $id){
        $reservacion = Reservacion::find($id);
        if(!$reservacion){
            $data = [
                "message"=> "Error al encontrar la reservacion",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $validator = Validator::make($request->all(), [
            "fecha_reservacion" => "required|date",
            "correo_electronico" => "required|email|max:255",
            "hora_inicio" => "required|date_format:H:i:s",
            "hora_final" => "required|date_format:H:i:s",
            "numero_mesa" => "required|integer"
        ]);

        if($validator->fails()){
            $data = [
                "message"=> "Error en la validación de los datos",
                "errores"=> $validator->errors(),
                "status"=> 400
            ];
            return response()->json( $data, 400);
        }

        $id_cliente = Cliente::where('correo_electronico', $request->correo_electronico)->value('id');
        if(!$id_cliente){
            $data = [
                "message"=> "Error al encontrar el id_cliente del cliente",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $num_mesa = Mesa::where("numero", $request->numero_mesa)->first();
        if(!$num_mesa){
            $data = [
                "message"=> "Error al encontrar el numero de la mesa",
                "status"=> 404
            ];
            return response()->json( $data, 404);
        }

        $reservacion->fecha_reservacion = $request->fecha_reservacion;
        $reservacion->id_cliente = $id_cliente;
        $reservacion->hora_inicio = $request->hora_inicio;
        $reservacion->hora_final = $request->hora_final;
        $reservacion->numero_mesa = $request->numero_mesa;

        $reservacion -> save();

        $data = [
            "message" => "Datos de la reservacion actualizados correctamente",
            "reservacion" => $reservacion,
            "status" => 201
        ];
        return response()->json( $data, 201);
    }
}
