<?php 

use App\Models\Siswa;
use App\Models\Guru;

function topFiveRank(): object
{
    $siswa = Siswa::all();

    $siswa->map(function($value) {
        $value->average = $value->average();
    });
    $siswa = $siswa->sortByDesc('average')->take(5);

    return $siswa;
}

function allStudent(): int
{
    return Siswa::count();
}

function allTeacher(): int
{
    return Guru::count();
}