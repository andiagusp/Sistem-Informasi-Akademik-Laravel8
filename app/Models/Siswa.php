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
}
