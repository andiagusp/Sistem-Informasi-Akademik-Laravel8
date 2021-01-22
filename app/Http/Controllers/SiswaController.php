<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(Request $request)
    { 
        if($request->has('s')) {
            #search data melalui method search()
            $siswa = $this->search($request->s);
        } else {
            # get data semua siswa Eloquent 
            $siswa = Siswa::all();
        }

        return  view('siswa.index', compact('siswa'));
    }

    public function create(Request $request)
    {
        /**
         * Create siswa menggunakan eloquent
         */
        Siswa::create($request->all());

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

        return redirect('/siswa')->with('message', 'Data berhasil diupdate');
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
