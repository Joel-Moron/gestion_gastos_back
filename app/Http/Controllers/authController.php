<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Usuario;

class authController extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'correo' => 'required|string|max:255',
                'usuario' => 'required|string|max:255',
                'nombre' => 'required',
                'apellidos' => 'required',
                'password' => 'required|min:6',
            ]);
            $errors = [];

            if (Usuario::where('usuario', $request->username)->exists()) $errors['username'] = 'activo';
            if (Usuario::where('correo', $request->username)->exists()) $errors['correo'] = 'activo';
            
            if (!empty($errors)) return response()->json(['message' => 'error, datos en uso', 'datos' => $errors], 403);
            
            $user = Usuario::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo' => $request->correo,
                'usuario' => $request->usuario,
                'password' => Hash::make($request->password),
            ],[]);

            DB::commit();
            return response()->json(['message' => 'usuario registrado correctamente'], 201);
        }catch (ValidationException $e){
            DB::rollBack();
            return response()->json(['message' => 'Datos incorrectos', 'errores'=>$e->errors()], 400);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al crear el usuario',$e], 500);
        }
    }



    public function login(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'user' =>'required',
                'password' => 'required'
            ]);
            
            $user = Usuario::where('usuario', $request->user)->first();
            if (!$user) {
                $user = Usuario::where('correo', $request->user)->first();
            }

            if ($user && Hash::check($request->password, $user->password)) {

                DB::commit();
                return response()->json(['data' => $user] , 200);
            }else{
                DB::rollBack();
                return response()->json(['message' => 'Credenciales incorrectas'], 401);
            }
        }catch (ValidationException $e){
            DB::rollBack();
            return response()->json($e->errors(), 400);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e , 500);
        }
        
    }
}
