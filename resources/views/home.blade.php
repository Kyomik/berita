@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <h1>Berita Terbaru</h1>
    <div class="row">
        @foreach($berita as $item)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $item['gambar'] }}" class="card-img-top" alt="{{ $item['judul_berita'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['judul_berita'] }}</h5>
                    <p class="card-text">{{ Str::limit($item['isi_berita'], 100) }}</p>
                    <a href="{{ url('/berita/' . $item['id_berita']) }}" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <h2>Berita Populer</h2>
    <div class="row">
        @foreach($beritaPopuler as $item)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $item['gambar'] }}" class="card-img-top" alt="{{ $item['judul_berita'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['judul_berita'] }}</h5>
                    <p class="card-text">{{ Str::limit($item['isi_berita'], 100) }}</p>
                    <a href="{{ url('/berita/' . $item['id_berita']) }}" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <h2>Kategori</h2>
    <ul class="list-group">
        @foreach($kategori as $item)
        <li class="list-group-item">
            <a href="{{ url('/' . $item['nama_kategori']) }}">{{ $item['nama_kategori'] }}</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection
