<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';
    protected $fillable = ['id_siswa', 'id_mapel', 'nama', 'semester'];

    #pivot tabel relation many to many
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'mapel_siswa', 'id_mapel', 'id_siswa')->withPivot('nilai');
    }

}
