<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Like;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $fotos = Foto::all();
        $likeCount = [];

        foreach ($fotos as $foto) {
            $likeCount[$foto->id] = Like::where('fotoId', $foto->id)->count();
        }

        return view('welcome',compact('fotos','likeCount'));
    }
}
