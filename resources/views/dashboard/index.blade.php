@extends('layout.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h1 class="panel-title">Top 5 Rank</h1>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Rank</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                    {{-- helper Global.php --}}
                                    @foreach (topFiveRank() as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->namaLengkap() }}</td>
                                        <td>{{ $s->average() }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-users"></i></span>
                            <p>
                                <span class="number">{{ allStudent() }}</span>
                                <span class="title">Total Siswa</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-user"></i></span>
                            <p>
                                <span class="number">{{ allTeacher() }}</span>
                                <span class="title">Total Guru</span>
                            </p>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@stop