<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = ['nama_depan', 'id_user', 'nama_belakang', 'jenis_kelamin', 'agama', 'alamat', 'avatar'];
    protected $primaryKey = 'id_siswa';

    public function getAvatar()
    {
        # avatar untuk user secara default
        if(! $this->avatar)
        {
            return asset('images/default.jpg');
        }

        return asset('images/'. $this->avatar);
    }

    #pivot tabel relation many to many
    public function mapel()
    {
        return $this->belongsToMany(Mapel::class, 'mapel_siswa', 'id_siswa', 'id_mapel')->withPivot('nilai')->withTimestamps();
    }

    /**
     * Custom function
     */
    
    public function average()
    {
        $total = 0;
        $count = 0;

        # penghitungan nilai rata-rata
        foreach($this->mapel as $mapel) 
        {
            $total = $total + $mapel->pivot->nilai;
            $count++;
        }

        return ($count == 0) ? $total : round($total / $count);
    }

    public function namaLengkap(): string
    {
        return "{$this->nama_depan} {$this->nama_belakang}";
    }

}
