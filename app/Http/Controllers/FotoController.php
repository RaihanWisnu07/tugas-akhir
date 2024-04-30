<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FotoController extends Controller
{
    public function index()
    {
        $albums = Album::where('userId', auth()->user()->id)->get();
        return view('dashboard.forms.foto', compact('albums'));
    }

    public function post(Request $request)
    {
        $validateData = $request->validate([
            'judulFoto' => 'required',
            'deskripsiFoto' => 'required',
            'lokasiFile' => 'required',
            'albumId' => 'required:exists:album,id',
        ]);

        $fileUrl = $request->file('lokasiFile')->store('public/foto');
        $urlFoto = URL::to('/').Storage::url($fileUrl);

        $foto = new Foto([
            'judulFoto' => $validateData['judulFoto'],
            'deskripsiFoto' => $validateData['deskripsiFoto'],
            'lokasiFile' => $urlFoto,
            'albumId' => $validateData['albumId'],
            'userId' => auth()->user()->id,
        ]);

        $foto->save();

        return redirect()->route('dashboard')->with('success', 'Foto berhasil ditambahkan');
    }

    public function like($id)
    {
        $photo = Foto::find($id);

        $userId = auth()->id();

        $existingLikes = Like::where('userId', $userId)->where('fotoId', $photo->id)->first();


    if ($existingLikes) {
        $existingLikes->delete();
    }else{
        $likes = new Like([
            'userId' => $userId,
            'fotoId' => $photo->id,
            'tanggalLike' => Carbon::now()->format('Y-m-d'),
            'namaUser' => auth()->user()->name,
        ]);
        $likes->save();
    }
    return redirect()->back();
    }

    public function destroy($id)
    {
        $foto = Foto::find($id);
        $komentar = Komentar::where('fotoId', $id)->get();
        Storage::delete($foto->lokasiFile);
        $foto->delete();
        return redirect('/dashboard');
    }
}
