<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;



class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')
                                ->paginate(5);

        return view('like.index', [
            'likes' => $likes
        ]);
    }

    public function like($image_id)
    {
        // Recoger datos del usuario y la imagen
        $user = Auth::user();
        
        // condicion para verificar si ya existe el like y no duplicarlo
        $isset_like = Like::where('user_id', $user->id)
                            ->count();

       
        
        if($isset_like == 0)
        {

            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
    
            // Guardar datos en la base de datos
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'El like ya existe !!'
            ]);
        }

    }

    public function dislike($image_id)
    {
         // Recoger datos del usuario y la imagen
        $user = Auth::user();
    
        // condicion para verificar si ya existe el like y no duplicarlo
        $like = Like::where('user_id', $user->id)
                            ->first();

    
        
        if($like)
        {
            // Eliminar el like
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'Has dado dislike!!'
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'El like no existe !!'
            ]);
        }
 
    }

}
