<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLaboratorium extends Model
{
    use HasFactory;

    protected $table = 'jadwal_laboratoriums';

    protected $fillable = [
        'laboratorium_id',
        'nama_matkul',
        'dosen',
        'kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class);
    }
}
