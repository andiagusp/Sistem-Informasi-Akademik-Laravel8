<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Mapel;

class ApiController extends Controller
{
    public function updateNilai(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        $siswa->mapel()->updateExistingPivot($request->pk, ['nilai' => $request->value]);
    }
}
