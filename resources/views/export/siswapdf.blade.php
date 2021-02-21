<style>
    .table {
        border: 1px solid #ddd;
    }
    th {
        border: 1px solid #ddd;
    }
    td {
        border: 1px solid #ddd;
    }
</style>

<table class="table">
    <tr>
        <th>Nama Lengkap</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Nilai Rata-Rata</th>
    </tr>
    @foreach ($siswa as $s)
        <tr>
            <td>{{ $s->namaLengkap() }}</td>
            <td>{{ $s->jenis_kelamin }}</td>
            <td>{{ $s->agama }}</td>
            <td>{{ $s->average() }}</td>
        </tr>
    @endforeach
</table>