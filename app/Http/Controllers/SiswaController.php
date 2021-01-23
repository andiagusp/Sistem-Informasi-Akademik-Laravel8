<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Siswa;
use App\Models\User;

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
         */
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

    public function show($id)
    {
        $siswa = Siswa::find($id);
        
        return view('siswa.profile', compact('siswa'));
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
