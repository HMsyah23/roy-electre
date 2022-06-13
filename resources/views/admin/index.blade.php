@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard Admin</h1>
@stop

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $users->count() }}</h3>

                    <p>Daftar Pengguna</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{ route('admin.users') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $kriterias->count() }}</h3>

                    <p>Daftar Kriteria</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="{{ route('admin.kriterias') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $paskibrakas->count() }}</h3>

                    <p>Daftar Calon Paskibraka</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.paskibrakas') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>ELECTRE</h3>

                    <p>Perankingan ELECTRE</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <a href="{{ route('admin.electres') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    Berhasil Menambahkan Data
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (session('errors'))
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
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <div class="card direct-chat direct-chat-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Daftar Calon Paskibraka Belum Tervalidasi
                        <span class="badge badge-primary"> {{ $paskibrakaB->count() }}</span>
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#staticBackdrop">
                            <i class="fas fa-plus"></i> Tambah Data Calon Paskibraka
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body mx-2 my-2 px-2 py-2">
                    @if (session('sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {!! Session::get('sukses') !!}
                        </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Usia</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paskibrakaB as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img class="img-thumbnail"
                                            src="{{ asset('public/paskibraka/foto_calon_anggota/' . $item->foto_calon_anggota) }}" alt="">
                                    </td>
                                    <td>{{ $item->nama_depan . ' ' . $item->nama_belakang }}</td>
                                    <td>{{ $item->asal_sekolah }}</td>
                                    <td>{{ $item->umur . ' Tahun' }}</td>
                                    <td>
                                        <div class="badge badge-secondary">
                                            Belum Divalidasi
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.paskibraka.show', $item->id) }}"
                                                class="btn btn-success">
                                                <i class="fas fa-check"></i> Validasi
                                            </a>
                                            {{-- <button type="button" class="btn btn-warning">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </button> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Usia</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
        <!-- right col -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambahkan Calon Anggota Paskibraka</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('calonPaskibraka.kirim') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- /.row (main row) -->
@stop

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-plugins/responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "columnDefs": [{
                    "width": "10%",
                    "targets": 1
                }],
                "language": {
                    "decimal": "",
                    "emptyTable": "Tidak ada data tersedia",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "infoFiltered": "(menyaring dari _MAX_ total entri)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Menampilkan _MENU_ entri",
                    "loadingRecords": "Loading...",
                    "processing": "Memproses...",
                    "search": "Pencarian:",
                    "zeroRecords": "Tidak ada data yang cocok",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": aktifkan penyortiran kolom secara ascending",
                        "sortDescending": ": aktifkan penyortiran kolom secara descending"
                    }
                },
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
