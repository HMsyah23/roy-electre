@extends('adminlte::page')

@section('title', 'Daftar Calon Paskibraka')

@section('content_header')
    <h1>Daftar Calon Paskibraka</h1>
@stop

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Telah Divalidasi</span>
            <span class="info-box-number">{{$sudah}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-warning"><i class="fas fa-info"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Belum Divalidasi</span>
            <span class="info-box-number">{{$belum}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-danger"><i class="fas fa-times"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Tidak Valid</span>
            <span class="info-box-number">{{$tidak}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <div class="card direct-chat direct-chat-primary">
          <div class="card-header">
            <h3 class="card-title"> 
              Daftar Calon Paskibraka Belum Tervalidasi
              <span class="badge badge-primary"> {{$paskibrakas->count()}}</span>
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-book"></i> Input Hasil Tes
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body mx-2 my-2 px-2 py-2">
            @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {!! Session::get('error') !!}
              </div>
            @endif
            @if(session('sukses'))
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
                @foreach ($paskibrakas as $item)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>
                    <img class="img-thumbnail" src="{{asset('public/paskibraka/foto_calon_anggota/'.$item->foto_calon_anggota)}}" alt="">
                  </td>
                  <td>{{$item->nama_depan.' '.$item->nama_belakang}}</td>
                  <td>{{$item->asal_sekolah}}</td>
                  <td>{{$item->umur.' Tahun'}}</td>
                  <td>
                    @if ($item->validasi == 0)
                      <div class="badge badge-secondary">
                        Belum Divalidasi
                      </div>
                    @elseif ($item->validasi == 1)
                      <div class="badge badge-success">
                        Sudah Divalidasi
                      </div>
                    @elseif ($item->validasi == 2)
                      <div class="badge badge-danger">
                        Tidak Valid
                      </div>
                    @endif
                    <br>
                    @if ($item->tes_fisik == 0)
                      <div class="badge badge-secondary">
                        Belum Melakukan Tes Fisik
                      </div>
                    @elseif ($item->tes_fisik == 1)
                      <div class="badge badge-success">
                        Sudah Melakukan Tes Fisik
                      </div>
                    @endif
                  </td>
                  <td>
                    <div class="btn-group">
                      <div class="btn-group">
                        <a href="{{route('admin.paskibraka.show',$item->id)}}" class="btn btn-info">
                          <i class="fas fa-eye"></i>
                        </a>
                        @if ($item->role == 1)
                        @else
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg-{{$item->id}}">
                          <i class="fas fa-trash"></i>
                        </button>
                        @endif
                      </div>
                    </div>

                    <div class="modal fade" id="modal-lg-{{$item->id}}">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header bg-danger">
                            <h5 class="modal-title"><i class="fas fa-trash"></i> Hapus Data Calon Paskibraka <br> <strong>{{$item->nama_depan.' '.$item->nama_belakang}}</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <form action="{{ route('admin.paskibraka.destroy',$item->id) }}"  method="POST" enctype="multipart/form-data">
                              @csrf
                             
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Hapus Data</button>
                          </form>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
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
    <!-- /.row (main row) -->

    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fas fa-book"></i> Input Hasil Tes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('admin.hasil') }}"  method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Nama Calon Paskibraka</label>
                      <select name="paskibraka" class="form-control">
                        @forelse ($paskibraka as $item)
                          <option value="{{$item->id}}">{{$item->nama_depan.' '.$item->nama_belakang}}</option>
                        @empty
                          <option value="null">Tidak Ada Calon Paskibraka</option>
                        @endforelse
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Lari</label>
                      <input type="number" name="lari" class="form-control" placeholder="Masukkan Skor Lari" value="{{old('lari')}}"  min="1" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Push Up</label>
                      <input type="number" name="push_up" class="form-control" placeholder="Masukkan Skor Push Up" value="{{old('push_up')}}"  min="1" required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Sit Up</label>
                      <input type="number" name="sit_up" class="form-control" placeholder="Masukkan Skor Sit Up" value="{{old('sit_up')}}"  min="1"  required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Pull Up</label>
                      <input type="number" name="pull_up" class="form-control" placeholder="Masukkan Skor Push Up" value="{{old('push_up')}}"  min="1"  required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Squat Jump</label>
                      <input type="number" name="squat_jump" class="form-control" placeholder="Masukkan Skor Squat Jump" value="{{old('squat_jump')}}"  min="1"  required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Skor Pelatihan Baris - ber Baris</label>
                      <input type="number" name="skor_pelatihan_baris_ber_baris" class="form-control" placeholder="Masukkan Skor Pelatihan Baris - ber Baris" value="{{old('skor_pelatihan_baris_ber_baris')}}"  min="1" max="100" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Kesehatan Mental</label>
                      <select name="wawancara" class="form-control">
                          <option value="5">Sangat Baik</option>
                          <option value="4">Baik</option>
                          <option value="3">Cukup Baik</option>
                          <option value="2">Kurang Baik</option>
                      </select>
                    </div>
                  </div>
                </div>
            
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@stop

@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/datatables-plugins/responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('js')
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script>
  $(function () {
    $("#example1").DataTable({
      "columnDefs": [
        { "width": "10%", "targets": 1 }
      ],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@stop