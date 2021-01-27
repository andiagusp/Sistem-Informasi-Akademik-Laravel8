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
                                <td><a href="/siswa/profile/{{ $s->id_siswa }}">{{ $s->nama_depan }}</a></td>
                                <td><a href="/siswa/profile/{{ $s->id_siswa }}">{{ $s->nama_belakang }}</a></td>
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
            <form method="post" action="/siswa/create" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_depan">Nama Depan</label>
                        <input type="text" name="nama_depan" id="nama_depan" placeholder="Isi Nama Depan" class="form-control" value="{{ old('nama_depan') }}">
                        @error('nama_depan') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_belakang">Nama Belakang</label>
                        <input type="text" name="nama_belakang" id="nama_belakang" placeholder="Isi Nama Belakang" class="form-control" value="{{ old('nama_belakang') }}">
                    </div>
                    @error('nama_belakang') <span class="help-block">{{ $message }}</span> @enderror
                    <div class="form-group">
                        <label for="email">Email</label> 
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email ..." class="form-control">
                    </div>
                    @error('email') <span class="help-block">{{ $message }}</span> @enderror
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="L" {{ (old('jenis_kelamin') == 'L')? 'selected':'' }}>Laki - Laki</option>
                            <option value="P" {{ (old('jenis_kelamin') == 'P')? 'selected':'' }}>Perempuan</option>
                        </select>
                    </div>
                    @error('jenis_kelamin') <span class="help-block">{{ $message }}</span> @enderror
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" name="agama" id="agama" placeholder="Isi Agama" value="{{ old('agama') }}">
                    </div>
                    @error('agama') <span class="help-block">{{ $message }}</span> @enderror
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" id="avatar" value="{{ old('avatar') }}" class="form-control">
                    </div>
                    @error('avatar') <span class="help-blocked">{{ $message }}</span> @enderror
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat') }}</textarea>
                    </div>
                    @error('alamat') <span class="help-block">{{ $message }}</span> @enderror
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
