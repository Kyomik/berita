@extends('layouts.admin')

@section('content')

<div class="container-admin">
    <form id="formEdit" action="{{ url('api/berita/edit') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_berita" value="{{ $berita->id_berita }}">
        <div class="form-group">
            <label>Judul</label>
            <input type="text" class="form-control" id="judulInput" name="judul" value="{{ $berita->judul_berita }}" disabled="true">
        </div>
        <div class="form-group" style="border: 1px solid black; padding: 10px 20px 10px 20px">
            <label style="display: block;">Pilih Kategori</label>
            @foreach($kategoris as $kategori)
                <input type="radio" class="btn-check" name="kategori" id="{{ $kategori->id_kategori }}" autocomplete="off">
                <label class="btn btn-secondary" for="{{ $kategori->id_kategori}}">{{ $kategori->nama_kategori }}</label>
            @endforeach
        </div>
        <div class="container-paragraf" id="paragrafContainer">
            <div class="form-group">
                @php $counter = 1; @endphp
                @foreach($berita->paragrafs as $paragraf)
                <label>Paragraf {{ $counter }}</label>
                <input type="hidden" name="id_paragraf[]" value="{{ $berita->id_berita }}">
                <textarea class="form-control" name="paragraf[]" rows="3">{{ $paragraf->isi_paragraf }}</textarea>
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-block" id="addParagrafButton">Tambah Paragraf</button>
        <div class="features">
            <button type="button" id="submitEdit" class="btn btn-primary col-sm-1" >Kirim</button>
        </div>
    </form>
</div>

@endsection
