<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        return view('dashboard.forms.album');
    }

    public function post(Request $request)
    {
        $validate = $request->validate([
            'namaAlbum' => 'required',
            'deskripsi' => 'required',
        ]);

        $album = new Album([
            'namaAlbum' => $validate['namaAlbum'],
            'deskripsi' => $validate['deskripsi'],
            'userId' => auth()->user()->id,
        ]);

        $album->save();

        return redirect()->route('dashboard')->with('success','Berhasil menambahkan album');
    }

}
