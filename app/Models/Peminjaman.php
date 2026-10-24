<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'user_id', 
        'laboratorium_id', 
        'tanggal_pinjam', 
        'jam_mulai', 
        'jam_selesai', 
        'keperluan', 
        'status', 
        'keterangan_admin'
    ];
    use HasFactory;

    protected $table = 'peminjaman';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class);
    }
}
