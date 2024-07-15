@extends('layouts.admin')

@section('title', 'Home')

@section('content')

<div class="container-admin" id="{{ $berita->id_berita }}">
    <div class="header-berita">
        <h4 class="judul-berita">{{ $berita->judul_berita }}</h4>
        <i class="tanggal-berita">{{ $berita->tanggal_berita }}</i>
    </div>
    <div class="container-berita row">
        <div class="col nav"></div>
        <div class="isi-berita col-md-8">
            @php $isFirst = true; @endphp
            @foreach($berita->paragrafs as $paragraf)
                @if($paragraf->status_paragraf == "upload")
                    @if($isFirst)
                        <div class="paragraf-utama">
                            <div class="gambar-berita"></div>
                            <p id="paragraf-utama">{{ $paragraf->isi_paragraf }}</p>
                        </div>
                        @php $isFirst = false; @endphp
                    @else
                        <p class="paragraf-berita upload">{{ $paragraf->isi_paragraf }}</p>
                    @endif
                @elseif($paragraf->status_paragraf == "edit")
                    <p class="paragraf-berita edit">{{ $paragraf->isi_paragraf }}</p>
                @endif
            @endforeach
            <button type="button" class="btn btn-primary btn-block" id="toggle-komentar">Buka Komentar</button>
        </div>
        <div class="col nav"></div>
    </div>
    <div class="container-komentar" style="display: none"> 
        @include('komentar')
    </div>
</div>

<script>

</script>

@endsection