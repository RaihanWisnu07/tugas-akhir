<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Komentar;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class KomentarController extends Controller
{
    public function index($id)
    {
        $photo = Foto::find($id);
        $comment = $photo->komentar()->get();

        return view('dashboard.komentar', compact('photo','comment'));
    }

    public function post(Request $request, $id)
    {
        $foto = Foto::find($id);
        $komen = new Komentar();
        $komen->komentar = $request->komentar;
        $komen->fotoId = $foto->id;
        $komen->userId = auth()->user()->id;
        $komen->save();

        return redirect()->back();
    }
}
