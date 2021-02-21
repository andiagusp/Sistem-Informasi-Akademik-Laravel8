<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
