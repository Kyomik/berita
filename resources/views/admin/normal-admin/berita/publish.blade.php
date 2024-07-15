@extends('layouts.admin')

@section('content')
<h4>
    @php
        $status = request()->query('status');
    @endphp
      @if($status)
        <script>alert("Tunggu hingga admin meng-acc nya")</script>    
      @endif
    </h4>
<div class="container-admin">
    <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Berita</a>
 
    <a href="{{ route('admin/berita/upload') }}"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tambah</button></a>

	</nav>
<div class="table-wrapper">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Judul</th>
      <th scope="col">Kategori</th>
      <th scope="col">Tanggal Upload</th>
      <th>Viewer</th>
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
      <td>{{ $data->views }}</td>
      <td>
          <a href="{{ route('berita/show', ['id' => $data->id_berita]) }}">
              <button class="btn btn-primary btn-xs">Preview</button>
          </a>
            <button type="button" data-id="{{$data->id_berita}}" class="btn btnKomentar btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">Komentar</button>
          <a href="{{ route('admin/berita/edit', ['id' => $data->id_berita]) }}">
            <button class="btn btn-danger btn-xs">Edit</button>
          </a>
      </td>
    </tr>
    @php $count++ @endphp
    @endforeach
  </tbody>
</table>
</div>
</div>

<div class="modal modalKomentar bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      @include('komentar')
    </div>
  </div>
</div>
@endsection