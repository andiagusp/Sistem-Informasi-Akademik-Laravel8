<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Guru;

use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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

    /**
     * Find siswa berdasarkan id
     * Model Binding
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Find siswa berdasarkan id
     * Model Binding
     */
    public function update(Request $request, Siswa $siswa)
    {
        
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

    public function tambahNilai(Request $request, Siswa $siswa)
    {
        /**
         * tambah nilai siswa berdasarkan id
         */

        # validate form nilai
        $request->validate([
            'nilai' => 'required|numeric',
            'pelajaran' => 'required'
        ]);

        # cek mata pelajaran apakah sudah ada didb atau belum
        if($siswa->mapel()->where('mapel_siswa.id_mapel', $request->pelajaran)->exists())
        {
            return redirect("/siswa/profile/{$siswa->id_siswa}")->with('fail', 'Data matapelajaran sudah ada');
        }

        # insert into pivot table mapel_siswa
        $siswa->mapel()->attach($request->pelajaran, ['nilai' => $request->nilai]);

        return redirect("/siswa/profile/{$siswa->id_siswa}")->with('message', 'Nilai berhasil ditambah');
    }

    public function show(Siswa $siswa)
    {
        # get mata pelajaran
        $matapelajaran = Mapel::all();

        # menyiapkan data untuk chart
        $categories = [];
        $data = [];

        foreach($matapelajaran as $mapel)
        {     
            if($siswa->mapel()->wherePivot('id_mapel', $mapel->id_mapel)->first())
            {
                $categories[] = $mapel->nama;
                $data[] = $siswa->mapel()->wherePivot('id_mapel', $mapel->id_mapel)->first()->pivot->nilai;
        
            }
        }
        
        return view('siswa.profile', compact('siswa', 'matapelajaran', 'categories', 'data'));
    }

    /**
     * Find siswa berdasarkan id
     * Model Binding
     */
    public function destroy(Siswa $siswa)
    {
        // delete siswa
        $siswa->delete();

        return redirect('/siswa')->with('message', 'Data berhasil dihapus');
    }

    public function deleteNilai(Siswa $siswa, $mapelID)
    {
        #delete nilai dari pivot table
        $siswa->mapel()->detach($mapelID);

        return redirect()->back()->with('fail', 'Data berhasil dihapus');
    }

    public function search($name)
    {
        # cari data siswa dengan nama depan
        $siswa = Siswa::where("nama_depan", "LIKE", "%{$name}%")->get();
        
        return $siswa;
    }

    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    public function exportPDF()
    {
        $siswa = Siswa::all();
        $pdf = PDF::loadView('export.siswapdf', compact('siswa'));
        return $pdf->download('siswa.pdf');
    }
    
}