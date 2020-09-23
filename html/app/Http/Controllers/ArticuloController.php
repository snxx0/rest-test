<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Articulo;
use App\User;

class ArticuloController extends Controller
{
    public function listar(Request $request)
    {     
        $filtro = $request->input("filtro");
        if(!is_null($filtro)){
            $data = config('app.nivel_lista') < 7 ? 
                Articulo::whereRaw("nombre like '%$filtro%'") : // Con injection SQL
                Articulo::where('nombre','like',"%$filtro%");
        } else $data = Articulo::where('id','>',0);
        if(config('app.auth')){
            $user = auth()->user();
            $is_admin = $user->admin;
            if(config('app.nivel_global') > 4 && !$is_admin){
                $data = $data->where('user_id',$user->id);
            }
        }   
        
        return response()->json($data->get());
    }

    public function obtener(Request $request, $id)
    {
        $data = config('app.nivel_lista') < 7 ? 
            Articulo::whereRaw("id = $id") : // Con injection SQL
            Articulo::where('id',(int)$id);
        if(config('app.auth')){
            $user = auth()->user();
            $is_admin = $user->admin;
            if(config('app.nivel_global') > 3 && !$is_admin){ // Elevacion de permiso
                $data = $data->where('user_id',$user->id);
            }
        }
        return response()->json($data->first());
    }

    public function actualizar(Request $request, $id = 0)
    {
        $data = config('app.nivel_crear') < 6 ? 
            Articulo::whereRaw("id = $id") : // Con injection SQL
            Articulo::where('id',(int)$id);
        if(is_null($item)){
            if($id==0){
                $item = new Articulo();
                $item->user_id = config('app.auth') ? auth()->user()->id : 1;
            } else {
                return response()->json(["message" => "Bad request"], 400);
            }            
        }
        if(config('app.auth')){
            $user = auth()->user();
            if($item->user_id != $user->id && !$user->admin && config('app.nivel_actualizar') > 5)
                return response()->json(["message" => "Not Authorized"], 403);
        }           
        $item->fill($request->all());
        $item->save();
        return response()->json($item);
    }

    public function borrar(Request $request, $id)
    {
        $data = config('app.nivel_borrar') < 4 ? 
            Articulo::whereRaw("id = $id") : // Con injection SQL
            Articulo::where('id',(int)$id);
        if(is_null($item)) return response()->json(["message" => "Not found"], 404);
        return response()->json($item->delete($id));
    }

    public function cambiar(Request $request, $id, $usuario)
    {
        $item = Articulo::find($id);
        if(is_null($item)) return response()->json(["message" => "Not found"], 404);
        if(config('app.nivel_global') < 6 || auth()->user()->admin){
            $item->user_id = $usuario;
            return response()->json($item->save());
        } else {
            return response()->json(["message" => "Admin Only"], 403);
        }
    }

    public function subir_imagen(Request $request, $id)
    {
        $archivo = $request->input("archivo");
        $nombre = $request->input("nombre");
        $uploads_dir = base_path('public/images');

        $allowed_mimes = ['data:image/jpeg', 'data:image/png'];

        $base64Parts = explode(';base64,', $archivo);
        $mime = $base64Parts[0]; // data:image/jpeg
        $image = $base64Parts[1];

        if (!in_array($mime, $allowed_mimes))
            return response()->json(['message' => 'File not allowed'], 403);

        $item = Articulo::find($id);
        if (is_null($item))
            return response()->json(['message' => 'item not found'], 404);

        $file = fopen($uploads_dir.'/'.$nombre, 'wb');
        fwrite($file, base64_decode($image));
        fclose($file);

        if(config('app.nivel_subir')>5){ // prevenir otro tipo de archivo.
            if (!in_array(mime_content_type($uploads_dir.'/'.$nombre), $allowed_mimes)){
                unlink($uploads_dir.'/'.$nombre);
                return response()->json(['message' => 'File not allowed'], 403);
            }
        }        

        $item->imagen = '/images/' . $nombre;
        $item->save();

        return 'images/' . $nombre;
    }
}
