@extends('layouts.admin')

@section('content')
<style type="text/css">
  .container-admin{
  }
</style>
<div class="container-admin">
    <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Berita</a>
 

  </nav>
<div class="table-wrapper">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Judul</th>
      <th scope="col">Kategori</th>
      <th scope="col">Admin</th>
      <th>Jumlah hari</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody class="features">
    @php $count = 1; @endphp
    @foreach($berita as $data)
    <tr>
      <th scope="row">{{ $count }}</th>
      <td>{{ $data->judul_berita }}</td>
      <td>{{ $data->kategori }}</td>
      <td>{{ $data->tanggal_berita }}</td>
      <td>Jumlah hari</td>
      <td>{{ $data->keterangan }}</td>
      <td>
          <a href="{{ route('berita/show', ['id' => $data->id_berita]) }}?status=draft">
        <button class="btn btn-primary btn-xs">Preview</button>
    </a>
            <button type="button" data-id="{{$data->id_berita}}" class="btn btnKomentar btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Acc</button>
          <a href="{{ route('admin/berita/edit', ['id' => $data->id_berita]) }}">
            <button class="btn btn-danger btn-xs">Decline</button>
          </a>
      </td>
    </tr>
    @php $count++ @endphp
    @endforeach
  </tbody>
</table>
  <div aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</div>
</div>
</div>

@endsection