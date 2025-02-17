@extends('layouts.admin')

@section('content')

<div class="container-admin">
    <form id="newsForm" action="{{ route('admin/berita/upload') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label>Judul</label>
        <input type="text" class="form-control" id="judulInput" name="judul" placeholder="Judul...">
      </div>
      <div class="form-group" style="border: 1px solid black; padding: 10px 20px 10px 20px">
        <label style="display: block;">Pilih Kategori</label>
        @foreach($kategoris as $kategori)
            <div class="btn-group-toggle" data-toggle="buttons" style="display: inline-block;">
                <label class="btn btn-secondary">
                    <input type="checkbox" name="kategori[]" value="{{ $kategori->id_kategori }}"> {{ $kategori->nama_kategori }}
                </label>
            </div>
        @endforeach
      </div>

      <div class="container-paragraf" id="paragrafContainer">
        <div class="form-group">
          <label>Paragraf 1</label>
          <textarea class="form-control" id="paragraf1" name="paragraf[]" rows="3"></textarea>
        </div>
      </div>
      <button type="button" class="btn btn-primary btn-block" id="addParagrafButton">Tambah Paragraf</button>
      <div class="features">
	      <button type="submit" id="submitButton" class="btn btn-primary col-sm-1">Kirim</button>
	      <button type="button" id="batalButton" class="btn btn-secondary col-sm-1" style="margin-left: 5px">Batal</button>
      </div>
    </form>
    
</div>

@endsection
