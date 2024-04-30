<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    protected $primarykey = 'id';
    protected $fillable = [
        'userId',
        'albumId',
        'judulFoto',
        'deskripsiFoto',
        'lokasiFile',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'albumId', 'id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class,'fotoId', 'id');
    }

    public function like()
    {
        return $this->hasMany(Like::class,'fotoId', 'id');
    }
}
