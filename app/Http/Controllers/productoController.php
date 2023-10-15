<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Tag;
use Illuminate\Validation\ValidationException;

class productoController extends Controller
{
    public function productoGet(Request $request, $id){
        try {
            $producto = Producto::where('usuario_id', $id)->get();
            return response()->json(['message' => 'Datos obtenidos', 'data' => $producto], 200);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Datos incorrectos', 'errores' => $e], 500);
        }
    
    }
    public function productoCreate(Request $request){
        try {
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'usuario_id' => 'required',
                'tag_id' => 'required',
            ]);
    
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'tag_id' => $request->tag_id,
                'usuario_id' => $request->usuario_id
            ]);

            return response()->json(['message' => 'producto creado', 'data' => $producto], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }

    public function productoDelete($id){
        try {
            $producto = Producto::where('id', $id)->first();

            if (!$producto) return response()->json(['message' => 'Error no esiste el producto'], 400);
    
            $producto->delete();
    
            return response()->json(['message' => 'Producto eliminado', 'data' => $producto], 200);

        }  catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }


    }
    public function productoUpdate(Request $request, $id){
        try {
            $producto = Producto::where('id', $id)->first();
            if (!$producto) return response()->json(['message' => 'Error no esiste el producto'], 400);

            $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'tag_id' => 'required',
            ]);
    
            $producto -> update([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'tag_id' => $request->tag_id,
            ]);

            return response()->json(['message' => 'Producto editado', 'data' => $producto], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }

    public function tagGet(Request $request, $id){
        try {
            $tag = Tag::where('usuario_id', $id)->get();
            return response()->json(['message' => 'Datos obtenidos', 'data' => $tag], 200);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Datos incorrectos', 'errores' => $e], 500);
        }
    
    }
    public function tagCreate(Request $request){
        try {
            $request->validate([
                'nombre' => 'required',
                'usuario_id' => 'required',
            ]);
    
            $tag = Tag::create([
                'nombre' => $request->nombre,
                'usuario_id' => $request->usuario_id
            ]);

            return response()->json(['message' => 'Tag creado', 'data' => $tag], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }

    public function tagDelete($id){
        try {
            $tag = Tag::where('id', $id)->first();

            if (!$tag) return response()->json(['message' => 'Error no esiste el tag'], 400);
    
            $tag->delete();
    
            return response()->json(['message' => 'Tag eliminado', 'data' => $tag], 200);

        }  catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }


    }
    public function tagUpdate(Request $request, $id){
        try {
            $tag = Tag::where('id', $id)->first();
            if (!$tag) return response()->json(['message' => 'Error no esiste el tag'], 400);

            $request->validate([
                'nombre' => 'required'
            ]);
    
            $tag -> update([
                'nombre' => $request->nombre
            ]);

            return response()->json(['message' => 'Tag editado', 'data' => $tag], 200);

        }catch (ValidationException $e){
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        } catch (\Eception $e) {
            return response()->json(['message' => 'Error de servidor', 'errores' => $e], 500);
        }
    }
}
