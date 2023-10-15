<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use Illuminate\Validation\ValidationException;

class ventaController extends Controller
{
    public function ventaGet(Request $request, $id){
        try {
            $venta = Venta::where('usuario_id', $id)->get();
            return response()->json(['message' => 'Datos obtenidos', 'data' => $venta], 200);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Datos incorrectos', 'errores' => $e], 500);
        }
    
    }
    public function ventaCreate(Request $request){
        try {
            $request->validate([
                'fecha' => 'required',
                'precio_venta' => 'required',
                'cantidad' => 'required',
                'producto_id' => 'required',
                'usuario_id' => 'required'
            ]);
            $producto = Producto::where('id', $request->producto_id)->first();
            if (!$producto) return response()->json(['message' => 'Error no esiste el producto con id '.$producto->producto_id], 400);
            $venta = Venta::create([
                'fecha' => $request->fecha,
                'precio_venta' => $request->precio_venta,
                'cantidad' => $request->cantidad,
                'producto_id' => $request->producto_id,
                'usuario_id' => $request->usuario_id
            ]);

            return response()->json(['message' => 'Venta creado', 'data' => $venta], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }

    public function ventaDelete($id){
        try {
            $venta = Venta::where('id', $id)->first();

            if (!$venta) return response()->json(['message' => 'Error no existe el venta'], 400);
    
            $venta->delete();
    
            return response()->json(['message' => 'Venta eliminado', 'data' => $venta], 200);

        }  catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }


    }
    public function ventaUpdate(Request $request, $id){
        try {
            $venta = Venta::where('id', $id)->first();
            if (!$venta) return response()->json(['message' => 'Error no existe la venta'], 400);

            $request->validate([
                'fecha' => 'required',
                'precio_venta' => 'required',
                'cantidad' => 'required',
                'producto_id' => 'required',
            ]);
    
            $venta -> update([
                'fecha' => $request->fecha,
                'precio_venta' => $request->precio_venta,
                'cantidad' => $request->cantidad,
                'producto_id' => $request->producto_id,
            ]);

            return response()->json(['message' => 'Venta editado', 'data' => $venta], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }
}
