@extends('layout.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="col-md-6">
                            <h1 class="panel-title">Data Siswa</h1>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn right" href="#" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="panel-body">
                        {{-- flash message --}}
                        @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
        
                        {{-- table siswa --}}
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($siswa as $s)
                            <tr>
                                <td>{{ $s->nama_depan }}</td>
                                <td>{{ $s->nama_belakang }}</td>
                                <td>{{ $s->jenis_kelamin }}</td>
                                <td>{{ $s->agama }}</td>
                                <td>{{ $s->alamat }}</td>
                                <td>
                                    <form action="/siswa/{{ $s->id_siswa }}" method="post">
                                        <a href="/siswa/edit/{{ $s->id_siswa }}" class="btn btn-warning text-light">Edit</a>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Hapus data siswa {{ $s->nama_depan }}')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tambah Data Siswa
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/siswa/create">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_depan">Nama Depan</label>
                        <input type="text" name="nama_depan" placeholder="Isi Nama Depan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_belakang">Nama Belakang</label>
                        <input type="text" name="nama_belakang" placeholder="Isi Nama Belakang" class="form-control">
                    </div>
                    <div class="form-group">
                        <select name="jenis_kelamin" class="form-control">
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" name="agama" placeholder="Isi Agama">
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
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
