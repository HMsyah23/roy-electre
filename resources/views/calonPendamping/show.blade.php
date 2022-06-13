@extends('adminlte::page')

@section('title', 'Calon Pendamping | Profil Pengguna')

@section('content_header')
    <h1>Calon Pendamping | Profil Pengguna</h1>
@stop

@section('content')
<div class="row">
  <div class="col">
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
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"
               src="{{asset('public/pendamping/foto/'.Auth::user()->pendamping->foto)}}"
               alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{Auth::user()->pendamping->nama_depan.' '.Auth::user()->pendamping->nama_belakang}}</h3>

        <p class="text-muted text-center">No.KTP : {{Auth::user()->pendamping->no_ktp}}</p>
        @if (Auth::user()->pendamping->jenis_kelamin == 1)
          <p class="text-muted text-center">Pria</p>
        @else
          <p class="text-muted text-center">Wanita</p>   
        @endif
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>No HP</b> <div class="float-right">{{Auth::user()->pendamping->no_hp}}</div>
          </li>
          <li class="list-group-item">
            <b>Email</b> <div class="float-right">{{Auth::user()->pendamping->email}}</div>
          </li>
          <li class="list-group-item">
            <b>Tanggal Lahir</b> <div class="float-right">{{Auth::user()->pendamping->tanggal_lahir}}</div>
          </li>
          <li class="list-group-item">
            <b>Usia</b> <div class="float-right">{{Auth::user()->pendamping->years.' Tahun'}}</div>
          </li>
          <li class="list-group-item">
            <b>Universitas</b> <div class="float-right">{{Auth::user()->pendamping->tanggal_lahir}}</div>
          </li>
          <li class="list-group-item">
            <b>Jenjang</b> <div class="float-right">{{Auth::user()->pendamping->tanggal_lahir}}</div>
          </li>
          <li class="list-group-item">
            <b>Alamat</b> <div class="float-right">{{Auth::user()->pendamping->alamat}}</div>
          </li>
          <li class="list-group-item">
            <b>KTP</b> <div class="float-right"><a href="{{asset('public/pendamping/foto_ktp/'.json_decode(Auth::user()->pendamping->ktp)->file)}}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i></a></div>
          </li>
          <li class="list-group-item">
            <b>Kartu Keluarga</b> <div class="float-right"><a href="{{asset('public/pendamping/foto_kk/'.json_decode(Auth::user()->pendamping->kk)->file)}}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i></a></div>
          </li>
          <li class="list-group-item">
            <b>Akta Kelahiran</b> <div class="float-right"><a href="{{asset('public/pendamping/akta_kelahiran/'.json_decode(Auth::user()->pendamping->akta_kelahiran)->file)}}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i></a></div>
          </li>
          <li class="list-group-item">
            <b>Ijazah</b> <div class="float-right"><a href="{{asset('public/pendamping/ijazah/'.json_decode(Auth::user()->pendamping->ijazah)->file)}}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i></a></div>
          </li>
          <li class="list-group-item">
            <b>SKCK</b> <div class="float-right"><a href="{{asset('public/pendamping/foto_skck/'.json_decode(Auth::user()->pendamping->skck)->file)}}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i></a></div>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-lg-9 col-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Detail Pengguna</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('calonPendamping.update',Auth::user()->pendamping->id) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <hr>
              <h5 class="text-bold"><u>Informasi Calon Pendamping</u></h5>
            </div>
            <div class="col">
              <div class="form-group">
                <label>No KTP</label>
                <input type="text" name="no_ktp" class="form-control" placeholder="Masukkan No KTP" value="{{Auth::user()->pendamping->no_ktp}}" required>
              </div>
              <div class="form-group">
                <label>Nama Depan</label>
                <input type="text" name="nama_depan" class="form-control" placeholder="Masukkan Nama Depan" value="{{Auth::user()->pendamping->nama_depan}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{Auth::user()->pendamping->email}}" required>
              </div>
              <div class="form-group">
                <label>Nama Belakang</label>
                <input type="text" name="nama_belakang" class="form-control" placeholder="Masukkan Nama Belakang" value="{{Auth::user()->pendamping->nama_belakang}}" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No Handphone" value="{{Auth::user()->pendamping->no_hp}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" value="{{Auth::user()->pendamping->tanggal_lahir}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                  <option @if(Auth::user()->pendamping->jenis_kelamin == 1) selected @endif value="1">Laki - Laki</option>
                  <option @if(Auth::user()->pendamping->jenis_kelamin == 2) selected @endif value="2">Wanita</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat...."> {{Auth::user()->pendamping->alamat}} </textarea>
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
                <input type="text" name="universitas" class="form-control" placeholder="Masukkan Universitas" value="{{Auth::user()->pendamping->universitas}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Jenjang</label>
                <select name="jenjang" class="form-control">
                  <option @if(Auth::user()->pendamping->jenjang == "S2/Sederajat") selected @endif value="S2/Sederajat">Sarjana S2 / Sederajat</option>
                  <option @if(Auth::user()->pendamping->jenjang == "S1/Sederajat") selected @endif value="S1/Sederajat">Sarjana S1 / Sederajat</option>
                  <option @if(Auth::user()->pendamping->jenjang == "D3/Sederajat") selected @endif value="D3/Sederajat">Diploma / Sederajat</option>
                  <option @if(Auth::user()->pendamping->jenjang == "SMA/SMK/Sederajat") selected @endif value="SMA/SMK/Sederajat">SMA/SMK / Sederajat</option>
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
                <label for="exampleFormControlFile1">Foto Calon Pendamping</label>
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
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </form>
    </div>
  </div>
  <!-- ./col -->
  {{-- <div class="col-lg-9 col-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Pendaftaran</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('calonPendamping.kirim') }}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <hr>
              <h5 class="text-bold"><u>Informasi Calon Pendamping</u></h5>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat...."> {{Auth::user()->pendamping->alamat}} </textarea>
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
                <input type="text" name="universitas" class="form-control" placeholder="Masukkan Universitas" value="{{Auth::user()->pendamping->universitas}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Jenjang</label>
                <select name="jenjang" class="form-control">
                  <option value="S2/Sederajat">Sarjana S2 / Sederajat</option>
                  <option value="S1/Sederajat">Sarjana S1 / Sederajat</option>
                  <option value="D3/Sederajat">Diploma / Sederajat</option>
                  <option value="SMA/SMK/Sederajat">SMA/SMK / Sederajat</option>
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
                <label for="exampleFormControlFile1">Foto Calon Pendamping</label>
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
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </form>
    </div>
  </div> --}}
  <!-- ./col -->
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop