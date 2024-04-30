<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Like;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $albums = album::where('userId', auth()->user()->id)->get();
        $fotos = foto::where('userId', auth()->user()->id)->get();
        $likeCount = [];

        foreach ($fotos as $foto) {
            $likeCount[$foto->id] = like::where('fotoId', $foto->id)->count();
        }

        return view('dashboard.index', ['fotos' => $fotos, 'albums' => $albums, 'likeCount' => $likeCount]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function sort($id){
        $fotos = Foto::where('userId', auth()->id())->where('albumId', $id)->get();
        $albums = album::where('userId', auth()->id())->get();

        $likeCount = [];

        foreach($fotos as $foto){
            $likeCount[$foto->id] = Like::where('fotoId', $foto->id)->count();
        }

        return view('dashboard.index', compact('fotos', 'albums', 'likeCount'));
    }
}
