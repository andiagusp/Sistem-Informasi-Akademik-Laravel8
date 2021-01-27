<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Mapel;

class SiswaController extends Controller
{
    public function index(Request $request)
    { 
        if($request->has('s'))
        {
            #search data melalui method search()
            $siswa = $this->search($request->s);
        } 
        else
        {
            # get data semua siswa Eloquent 
            $siswa = Siswa::all();
        }

        return  view('siswa.index', compact('siswa'));
    }

    public function create(Request $request)
    {
        /**
         * Create siswa menggunakan eloquent
         * sekaligus membuat user akun login
         */

        # validate form create
        $request->validate([
            'nama_depan' => 'required|alpha',
            'nama_belakang' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'agama' => 'required|alpha',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'avatar' => 'mimes:jpg,jpeg,png'
        ]);
        
        # insert data user role default: siswa
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(60);
        $user->save();
        
        # insert data siswa
        $request->request->add(['id_user' => $user->id]);
        $siswa = Siswa::create($request->all());

        # pengecekan avatar
        if($request->hasFile('avatar'))
        {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        
        return redirect('/siswa')->with('message', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        /**
         * Find siswa berdasarkan id
         */
        $siswa = Siswa::find($id);

        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        /**
         * Find siswa berdasarkan id
        **/
        $siswa = Siswa::find($id);
        
        /**
         * Update siswa dengan eloquent
         */
        $siswa->update($request->all());

        # cek file foto ada yg diupload dan simpan ke storage images
        if($request->hasFile('avatar'))
        {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return redirect('/siswa')->with('message', 'Data berhasil diupdate');
    }

    public function tambahNilai(Request $request, $idSiswa)
    {
        /**
         * tambah nilai siswa berdasarkan id
        **/
        
        # find siswa id
        $siswa = Siswa::find($idSiswa);

        # validate form nilai
        $request->validate([
            'nilai' => 'required|numeric',
            'pelajaran' => 'required'
        ]);

        # cek mata pelajaran apakah sudah ada didb atau belum
        if($siswa->mapel()->where('mapel_siswa.id_mapel', $request->pelajaran)->exists())
        {
            return redirect("/siswa/profile/{$idSiswa}")->with('fail', 'Data matapelajaran sudah ada');
        }

        # insert into pivot table mapel_siswa
        $siswa->mapel()->attach($request->pelajaran, ['nilai' => $request->nilai]);

        return redirect("/siswa/profile/{$idSiswa}")->with('message', 'Nilai berhasil ditambah');
    }

    public function show($id)
    {
        # find siswa id
        $siswa = Siswa::find($id);

        # get mata pelajaran
        $matapelajaran = Mapel::all();
        
        return view('siswa.profile', compact('siswa', 'matapelajaran'));
    }

    public function destroy($id)
    {
        /**
         * Find siswa berdasarkan id
         */
        $siswa = Siswa::find($id);

        // delete siswa
        $siswa->delete();

        return redirect('/siswa')->with('message', 'Data berhasil dihapus');
    }

    public function search($name)
    {
        # cari data siswa dengan nama depan
        $siswa = Siswa::where("nama_depan", "LIKE", "%{$name}%")->get();
        
        return $siswa;
    }
}