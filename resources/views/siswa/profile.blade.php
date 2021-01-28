@extends('layout.master')
    
@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="panel panel-profile">
                    <div class="clearfix">
                        <!-- LEFT COLUMN -->
                        <div class="profile-left">
                            <!-- PROFILE HEADER -->
                            <div class="profile-header">
                                <div class="overlay"></div>
                                <div class="profile-main">
                                    <img src="{{ $siswa->getAvatar() }}" width="100" class="img-circle" alt="Avatar">
                                    <h3 class="name">{{ $siswa->nama_depan }}</h3>
                                    <span class="online-status status-available">Available</span>
                                </div>
                                <div class="profile-stat">
                                    <div class="row">
                                        <div class="col-md-4 stat-item">
                                            {{ $siswa->mapel->count() }} <span>Mata Pelajaran</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            15 <span>Awards</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            2174 <span>Points</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE HEADER -->
                            <!-- PROFILE DETAIL -->
                            <div class="profile-detail">
                                <div class="profile-info">
                                    <h4 class="heading">Data Diri</h4>
                                    <ul class="list-unstyled list-justify">
                                        <li>Jenis Kelamin <span>{{ $siswa->jenis_kelamin }}</span></li>
                                        <li>Agama <span>{{ $siswa->agama }}</span></li>
                                        <li>Alamat <span>{{ $siswa->alamat }}</span></li>
                                    </ul>
                                </div>
                                <div class="text-center">
                                    <a href="/siswa/edit/{{ $siswa->id_siswa }}" class="btn btn-warning">Edit Profile</a>
                                </div>
                            </div>
                            <!-- END PROFILE DETAIL -->
                        </div>
                        <!-- END LEFT COLUMN -->
                        <!-- RIGHT COLUMN -->
                        <div class="profile-right">
                            {{-- tabel kanan --}}

                            {{-- tombol button nilai --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNilai">
                                Tambah Nilai
                            </button>

                            {{-- message --}}
                            @if (session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @elseif (session('fail'))
                                <div class="alert alert-danger">{{ session('fail') }}</div>
                            @endif

                            <div class="panel">
                                <div class="panel-heading">
                                    <h1 class="panel-title">
                                        Mata Pelajaran
                                    </h1>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Semester</th>
                                            <th>Nilai</th>
                                        </tr>
                                        @foreach ($siswa->mapel as $mapel)
                                            <tr>
                                                <td>{{ $mapel->kode }}</td>
                                                <td>{{ $mapel->nama }}</td>
                                                <td>{{ $mapel->semester }}</td>
                                                <td>{{ $mapel->pivot->nilai }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <div class="panel">
                                <div id="chart-nilai">

                                </div>
                            </div>
                        </div>
                        <!-- END RIGHT COLUMN -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    {{-- Tambah Nilai Siswa --}}
    <div class="modal fade" id="modalNilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Tambah Nilai <b> {{ $siswa->nama_depan }} </b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/siswa/tambahnilai/{{ $siswa->id_siswa }}">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pelajaran">Mata Pelajaran</label>
                            <select name="pelajaran" id="pelajaran" class="form-control">
                                @foreach ($matapelajaran as $m)
                                    <option value="{{ $m->id_mapel }}">{{ $m->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input type="text" name="nilai" id="nilai" class="form-control">
                        </div>
                        @error('nilai') <span class="help-block"> {{ $message }} </span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('chart')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('chart-nilai', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Laporan Nilai Siswa'
        },
        xAxis: {
            categories: {!! json_encode($categories) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Nilai',
            data: {!! json_encode($data) !!}
        }]
    });
</script>
    
@endsection