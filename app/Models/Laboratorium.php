<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama', 'deskripsi', 'kapasitas'])]
class Laboratorium extends Model
{
    use HasFactory;

    protected $table = 'laboratoriums';

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalLaboratorium::class);
    }
}
