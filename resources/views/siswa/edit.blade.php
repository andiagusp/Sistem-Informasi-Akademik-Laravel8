@extends('layout.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        {{-- heading --}}
                        <div class="panel-heading">
                            <h1 class="panel-title">Edit Data Siswa</h1>
                        </div>
                        {{-- panel body --}}
                        <div class="panel-body">
                            <form action="/siswa/{{ $siswa->id_siswa }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                    
                                <div class="form-group">
                                    <label for="nama_depan">Nama Depan</label>
                                    <input type="text" class="form-control" name="nama_depan" value="{{ $siswa->nama_depan }}">
                                </div>
                    
                                <div class="form-group">
                                    <label for="nama_belakang">Nama Belakang</label>
                                    <input type="text" name="nama_belakang" value="{{ $siswa->nama_belakang }}" class="form-control">
                                </div>
                    
                                <div class="form-group">
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki - Laki</option>
                                        <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                    
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input type="text" name="agama" value="{{ $siswa->agama }}" class="form-control">
                                </div>
                    
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control">{{ $siswa->alamat }}</textarea>
                                </div>
                    
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <a href="/siswa" class="btn btn-warning">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection