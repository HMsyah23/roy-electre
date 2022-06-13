@extends('adminlte::page')

@section('title', 'Calon Paskibraka | Profil')

@section('content_header')
    <h1>Calon Paskibraka | Profil</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-3 col-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"
               src="{{asset('public/paskibraka/foto_calon_anggota/'.$paskibraka->foto_calon_anggota)}}"
               alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{$paskibraka->nama_depan.' '.$paskibraka->nama_belakang}}</h3>

        <p class="text-muted text-center">No.KTP : {{$paskibraka->no_ktp}}</p>
        @if ($paskibraka->jenis_kelamin == 1)
          <p class="text-muted text-center">Pria</p>
        @else
          <p class="text-muted text-center">Wanita</p>   
        @endif
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>No HP</b> <div class="float-right">{{$paskibraka->no_hp}}</div>
          </li>
          <li class="list-group-item">
            <b>Email</b> <div class="float-right">{{$paskibraka->email}}</div>
          </li>
          <li class="list-group-item">
            <b>Tanggal Lahir</b> <div class="float-right">{{$paskibraka->tanggal_lahir}}</div>
          </li>
          <li class="list-group-item">
            <b>Usia</b> <div class="float-right">{{$paskibraka->years.' Tahun'}}</div>
          </li>
          <li class="list-group-item">
            <b>Universitas</b> <div class="float-right">{{$paskibraka->tanggal_lahir}}</div>
          </li>
          <li class="list-group-item">
            <b>Jenjang</b> <div class="float-right">{{$paskibraka->tanggal_lahir}}</div>
          </li>
          <li class="list-group-item">
            <b>Alamat</b> <div class="float-right">{{$paskibraka->alamat}}</div>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- ./col -->
  <div class="col-lg-9 col-12">
    @if (Session::has('sukses'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('sukses') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
    </div>
    @endif
@if (Session::has('error'))
    <div class="alert alert-dangera lert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
    </div>
    @endif
    @if(session('errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Terdapat Kesalahan :
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
    <div class="card card-primary card-outline">
      <!-- form start -->
      <form action="{{ route('admin.paskibraka.validasi',$paskibraka->id) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <h5 class="text-bold"><u>Informasi Calon Paskibraka</u></h5>
              <hr>
              <ul>
                <li class="list-group-item">
                  <b>Kartu Pelajar</b> <div class="float-right"><a href="{{asset('public/paskibraka/foto_kartu_pelajar/'.json_decode($paskibraka->foto_kartu_pelajar)->file)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-file-pdf"></i></a></div>
                </li>
                <li class="list-group-item">
                  <b>Scan Nilai Rapor</b> <div class="float-right"><a href="{{asset('public/paskibraka/scan_nilai_rapor/'.json_decode($paskibraka->scan_nilai_rapor)->file)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-file-pdf"></i></a></div>
                </li>
                <li class="list-group-item">
                  <b>File STTB SLTP</b> <div class="float-right"><a href="{{asset('public/paskibraka/sttb_sltp/'.json_decode($paskibraka->sttb_sltp)->file)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-file-pdf"></i></a></div>
                </li>
                <li class="list-group-item">
                  <b>Surat Izin Orang Tua</b> <div class="float-right"><a href="{{asset('public/paskibraka/surat_izin_orang_tua/'.json_decode($paskibraka->surat_izin_orang_tua)->file)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-file-pdf"></i></a></div>
                </li>
                <li class="list-group-item">
                  <b>Surat Pengantar Kepsek</b> <div class="float-right"><a href="{{asset('public/paskibraka/surat_pengantar_kepsek/'.json_decode($paskibraka->surat_pengantar_kepsek)->file)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-file-pdf"></i></a></div>
                </li>
                <li class="list-group-item">
                  <b>Surat Pernyataan</b> <div class="float-right"><a href="{{asset('public/paskibraka/surat_pernyataan/'.json_decode($paskibraka->surat_pernyataan)->file)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-file-pdf"></i></a></div>
                </li>
              </ul>
            </div>
            </div>
          </div>
        <!-- /.card-body -->

        <div class="card-footer d-flex justify-content-center">
          <button type="submit" name="valid" value="1" class="btn btn-success mt-1 ml-1"><i class="fas fa-check"></i> Valid</button>
          <button type="submit" name="valid" value="2" class="btn btn-danger mt-1 ml-1"><i class="fas fa-times"></i> Tidak Valid</button>
        </div>
      </form>
    </div>
  
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Detail Calon Anggota Paskibraka</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('calonPaskibraka.update',$paskibraka->id) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <hr>
              <h5 class="text-bold"><u>Informasi Calon Paskibraka</u></h5>
            </div>
            <div class="col">
              <div class="form-group">
                <label>NISN</label>
                <input type="text" name="no_ktp" class="form-control" placeholder="Masukkan NISN" value="{{$paskibraka->nisn}}" required>
              </div>
              <div class="form-group">
                <label>Nama Depan</label>
                <input type="text" name="nama_depan" class="form-control" placeholder="Masukkan Nama Depan" value="{{$paskibraka->nama_depan}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{$paskibraka->email}}" required>
              </div>
              <div class="form-group">
                <label>Nama Belakang</label>
                <input type="text" name="nama_belakang" class="form-control" placeholder="Masukkan Nama Belakang" value="{{$paskibraka->nama_belakang}}" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No Handphone" value="{{$paskibraka->no_hp}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" value="{{$paskibraka->tanggal_lahir}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                  <option @if($paskibraka->jenis_kelamin == 1) selected @endif value="1">Laki - Laki</option>
                  <option @if($paskibraka->jenis_kelamin == 2) selected @endif value="2">Wanita</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat...."> {{$paskibraka->alamat}} </textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <hr>
              <h5 class="text-bold"><u>Informasi Pendidikan</u></h5>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Universitas</label>
                <input type="text" name="universitas" class="form-control" placeholder="Masukkan Universitas" value="{{$paskibraka->universitas}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Jenjang</label>
                <select name="jenjang" class="form-control">
                  <option @if($paskibraka->jenjang == "S2/Sederajat") selected @endif value="S2/Sederajat">Sarjana S2 / Sederajat</option>
                  <option @if($paskibraka->jenjang == "S1/Sederajat") selected @endif value="S1/Sederajat">Sarjana S1 / Sederajat</option>
                  <option @if($paskibraka->jenjang == "D3/Sederajat") selected @endif value="D3/Sederajat">Diploma / Sederajat</option>
                  <option @if($paskibraka->jenjang == "SMA/SMK/Sederajat") selected @endif value="SMA/SMK/Sederajat">SMA/SMK / Sederajat</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <hr>
              <h5 class="text-bold"><u>Unggah Berkas</u></h5>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="exampleFormControlFile1">Foto Calon Paskibraka</label>
                <input name="foto" type="file" class="form-control-file" id="exampleFormControlFile1">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="exampleFormControlFile1">Foto SKCK</label>
                <input name="skck" type="file" class="form-control-file" id="exampleFormControlFile1">
              </div>
            </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Unggah Berkas Foto KTP</label>
                    <input name="ktp" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Unggah Berkas Foto KK (Kartu Keluarga)</label>
                    <input name="kk" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="exampleFormControlFile1">Unggah Berkas Akta Kelahiran</label>
                  <input name="akta_kelahiran" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">Unggah Berkas Ijazah</label>
                  <input name="ijazah" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
              </div>
            </div>
          </div>
        <!-- /.card-body -->

        <div class="card-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>
      </form>
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