<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TipoGasto;
use App\Models\Gasto;
use Illuminate\Validation\ValidationException;

class GastoController extends Controller
{
    public function gastoGet(Request $request, $id){
        try {
            $gasto = Gasto::where('usuario_id', $id)->get();
            return response()->json(['message' => 'Datos obtenidos', 'data' => $gasto], 200);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Datos incorrectos', 'errores' => $e], 500);
        }
    
    }
    public function gastoCreate(Request $request){
        try {
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'fecha' => 'required',
                'usuario_id' => 'required',
                'tipo_gasto_id' => 'required',
            ]);
            $tipoGasto = TipoGasto::where('id', $request->tipo_gasto_id)->first();
            if (!$tipoGasto) return response()->json(['message' => 'Error no existe el tipo gasto'], 400);
    
            $gasto = Gasto::create([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'fecha' => $request->fecha,
                'tipo_gasto_id' => $request->tipo_gasto_id,
                'usuario_id' => $request->usuario_id
            ]);

            return response()->json(['message' => 'Gasto creado', 'data' => $gasto], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }

    public function gastoDelete($id){
        try {
            $gasto = Gasto::where('id', $id)->first();

            if (!$gasto) return response()->json(['message' => 'Error no existe el producto'], 400);
    
            $gasto->delete();
    
            return response()->json(['message' => 'Gasto eliminado', 'data' => $gasto], 200);

        }  catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }


    }
    public function gastoUpdate(Request $request, $id){
        try {
            $gasto = Gasto::where('id', $id)->first();
            if (!$gasto) return response()->json(['message' => 'Error no esiste el producto'], 400);

            $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'fecha' => 'required',
                'tipo_gasto_id' => 'required',
            ]);

            $tipoGasto = TipoGasto::where('id', $request->tipo_gasto_id)->first();
            if (!$tipoGasto) return response()->json(['message' => 'Error no existe el tipo gasto'], 400);
    
            $gasto -> update([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'fecha' => $request->fecha,
                'tipo_gasto_id' => $request->tipo_gasto_id,
            ]);

            return response()->json(['message' => 'Gasto editado', 'data' => $gasto], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }

    public function tipoGastoGet(Request $request, $id){
        try {
            $tipoGasto = TipoGasto::where('usuario_id', $id)->get();
            return response()->json(['message' => 'Datos obtenidos', 'data' => $tipoGasto], 200);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Datos incorrectos', 'errores' => $e], 500);
        }
    
    }
    public function tipoGastoCreate(Request $request){
        try {
            $request->validate([
                'nombre' => 'required',
                'usuario_id' => 'required',
            ]);
    
            $tipoGasto = TipoGasto::create([
                'nombre' => $request->nombre,
                'usuario_id' => $request->usuario_id
            ]);

            return response()->json(['message' => 'Tipo Gasto creado', 'data' => $tipoGasto], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }

    public function tipoGastoDelete($id){
        try {
            $tipoGasto = TipoGasto::where('id', $id)->first();

            if (!$tipoGasto) return response()->json(['message' => 'Error no existe el tipoGasto'], 400);
    
            $tipoGasto->delete();
    
            return response()->json(['message' => 'Tipo Gasto eliminado', 'data' => $tipoGasto], 200);

        }  catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }


    }
    public function tipoGastoUpdate(Request $request, $id){
        try {
            $tipoGasto = TipoGasto::where('id', $id)->first();
            if (!$tipoGasto) return response()->json(['message' => 'Error no esiste el tipoGasto'], 400);

            $request->validate([
                'nombre' => 'required'
            ]);
    
            $tipoGasto -> update([
                'nombre' => $request->nombre
            ]);

            return response()->json(['message' => 'Tag editado', 'data' => $tipoGasto], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }
}
