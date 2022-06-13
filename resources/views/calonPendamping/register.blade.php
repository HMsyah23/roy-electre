<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pendaftaran Calon Anggota Paskibraka</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Dinas Pemuda dan Olahraga Kabupaten Kutai Barat</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Form Pendaftaran Calon Anggota Paskibraka</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col text-left">
                            <h1 class="m-0"> Form Pendaftaran Calon Anggota Paskibraka</h1>
                            <h5><small>Isi Form Pendaftaran Dengan Data Sebenar - benarnya</small></h5>
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            @if (session('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Terdapat Kesalahan :
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (session('sukses'))
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <h5 class="card-title">Selamat
                                            <strong>{{ Session::get('sukses') }}</strong> Anda Berhasil Mendaftar
                                            sebagai Calon Anggota Paskibraka
                                        </h5>
                                        <br>
                                        <span>Silahkan Login Ke Halaman Dashboard Anda</span>
                                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                    </div>
                                </div><!-- /.card -->
                            @else
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Pendaftaran</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="{{ route('calonPaskibraka.kirim') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr>
                                                    <h5 class="text-bold"><u>Informasi Calon Anggota Paskibraka</u>
                                                    </h5>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>NISN</label>
                                                        <input type="text" name="nisn" class="form-control"
                                                            placeholder="Masukkan NISN" value="{{ old('nisn') }}"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Depan</label>
                                                        <input type="text" name="nama_depan" class="form-control"
                                                            placeholder="Masukkan Nama Depan"
                                                            value="{{ old('nama_depan') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            placeholder="Masukkan Email" value="{{ old('email') }}"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Belakang</label>
                                                        <input type="text" name="nama_belakang" class="form-control"
                                                            placeholder="Masukkan Nama Belakang"
                                                            value="{{ old('nama_belakang') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Nomor HP</label>
                                                        <input type="text" name="no_hp" class="form-control"
                                                            placeholder="Masukkan No Handphone"
                                                            value="{{ old('no_hp') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir" class="form-control"
                                                            placeholder="Masukkan Tanggal Lahir" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-control">
                                                            <option value="1">Laki - Laki</option>
                                                            <option value="2">Wanita</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat...."> {{ old('alamat') }} </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Tinggi Badan</label>
                                                        <input type="number" name="tinggi_badan" class="form-control"
                                                            placeholder="Masukkan Tinggi Badan"
                                                            value="{{ old('tinggi_badan') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Berat Badan</label>
                                                        <input type="number" name="berat_badan" class="form-control"
                                                            placeholder="Masukkan Berat Badan"
                                                            value="{{ old('berat_badan') }}" required>
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
                                                        <label>Asal Sekolah</label>
                                                        <input type="text" name="asal_sekolah" class="form-control"
                                                            placeholder="Masukkan Sekolah"
                                                            value="{{ old('sekolah') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <input type="text" name="alamat_sekolah" class="form-control"
                                                            placeholder="Masukkan Alamat Sekolah"
                                                            value="{{ old('alamat_sekolah') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr>
                                                    <h5 class="text-bold"><u>Unggah Berkas</u></h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Foto Calon Anggota
                                                            Paskibraka*</label>
                                                        <small>Mengenakan pakaian seragam sekolah dengan latar belakang
                                                            warna merah</small>
                                                        <input name="foto_calon_anggota" type="file"
                                                            class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Unggah Berkas Surat
                                                            Pernyataan*</label>
                                                        <small>(Belum Pernah Menjadi Peserta PASKIBRAKA tingkat
                                                            Kab\kota, provinsi, dan
                                                            Nasional)</small>
                                                        <input name="surat_pernyataan" type="file"
                                                            class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Unggah Surat Pengantar dari
                                                            Kepala Sekolah*</label>
                                                        <small>Mengenakan pakaian seragam sekolah dengan latar belakang
                                                            warna merah</small>
                                                        <input name="surat_pengantar_kepsek" type="file"
                                                            class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Unggah Scan Nilai Rapor
                                                            Terakhir*</label>
                                                        <input name="scan_nilai_rapor" type="file"
                                                            class="form-control-file">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Unggah Berkas Kartu
                                                            Pelajar*</label>
                                                        <input name="foto_kartu_pelajar" type="file"
                                                            class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Unggah Berkas STTB SLTP /
                                                            Sederajat*</label>
                                                        <input name="sttb_sltp" type="file" class="form-control-file">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlFile1">Unggah Berkas Surat Izin
                                                            Tertulis dari Orang Tua /
                                                            Wali*</label>
                                                        <input name="surat_izin_orang_tua" type="file"
                                                            class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="label">Keterangan :</div>
                                                    <ul>
                                                        <li>*File Wajib Diunggah</li>
                                                    </ul>
                                                </div>
                                            </div>


                                            <div class="card-footer d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Dinas Pemuda dan Olahraga Kabupaten Kutai Barat
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021 <a href="#">Roy</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
