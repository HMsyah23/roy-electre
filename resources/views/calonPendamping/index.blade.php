@extends('adminlte::page')

@section('title', 'Dashboard Calon Pendamping')

@section('content_header')
    <h1>Dashboard Calon Pendamping</h1>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
  <div class="row text-center">
      <div class="col">
          <img src="{{asset('vendor/adminlte/dist/img/AdminLTELogo.png')}}" alt="" style="width:15%;">
          <h2>Selamat Datang <br> <strong>{{Auth::user()->pendamping->nama_depan}} {{Auth::user()->pendamping->nama_belakang}}</strong></h2>
          <h5>Dashboard Calon Pendamping </h5>
          <div class="col-lg-8 offset-lg-2">
            @if (Auth::user()->pendamping->validasi == 0)
              <div class="alert alert-primary" role="alert">
                Berkas Anda masih dalam tahap validasi, silahkan kembali ke laman ini beberapa saat lagi.
              </div>
            @elseif (Auth::user()->pendamping->validasi == 1)
              <div class="alert alert-success" role="alert">
                Selamat Anda Dinyatakan Lulus Seleksi Pada Tahap Berkas, Silahkan Mendatangi Kantor BNN Untuk Melakukan Tes Selanjutnya.
              </div>
            @elseif (Auth::user()->pendamping->validasi == 2)
              <div class="alert alert-danger" role="alert">
                Mohon Maaf, Anda Kami Tolak Karena Anda Tidak Sesuai Dengan Kriteria Kami.
              </div>
            @elseif (Auth::user()->pendamping->validasi == 3)
              <div class="alert alert-info" role="alert">
                Selamat Anda Berhasil Diterima Menjadi Pendamping Pecandu Narkoba. Silahkan Datang Ke Kantor BNN, untuk menerima informasi lebih lanjut.
              </div>
            @endif
          </div>
      </div>
  </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-3 offset-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h4><strong>Profile Pengguna</strong></h4>
        <p><strong>Calon Pendamping</strong></p>
      </div>
      <div class="icon">
        <i class="fas fa-user-edit"></i>
      </div>
      <a href="{{route('pendamping.profile')}}" class="small-box-footer">
        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h4><strong>Ganti Password</strong></h4>
        <p><strong>Calon Pendamping</strong></p>
      </div>
      <div class="icon">
        <i class="fas fa-key"></i>
      </div>
      <a href="{{route('pendamping.gantiPassword')}}" class="small-box-footer">
        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop