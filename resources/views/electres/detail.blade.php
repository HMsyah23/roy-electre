@extends('adminlte::page')

@section('title', 'Daftar Kriteria')

@section('content_header')
    <h1>Halaman Perhitungan Moora</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="card ">
          <div class="card-header ">
              <h4 class="card-title">Langkah Perhitungan Moora</h4>
          </div>
          <div class="card-body ">
              <div class="row">
                  <div class="col-md-4">
                      <ul class="nav nav-pills nav-pills-primary flex-column" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#link4" role="tablist">
                                  1. Nilai Kriteria
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#link5" role="tablist">
                                  2. Membuat Matriks Keputusan
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#link6" role="tablist">
                                  3. Normalisasi Matriks
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#link7" role="tablist">
                                  4. Nilai Optimasi
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#link8" role="tablist">
                                  5. Perangkingan
                              </a>
                          </li>
                      </ul>
                  </div>
                  <div class="col-md-8">
                      <div class="tab-content">
                          <div class="tab-pane active" id="link4">
                              @foreach ($kriterias as $k)
                              <p> 
                                  <button class="btn btn-primary btn-block text-left" type="button" data-toggle="collapse" data-target="#kriteria{{$k->id}}" aria-expanded="false" aria-controls="kriteria{{$k->id}}">
                                      {{$k->kode}}. {{$k->nama}} ({{$k->bobot * 100}}%) ({{$k->tipe}})
                                  </button>
                              </p>
                              <div class="collapse" id="kriteria{{$k->id}}">
                                  <div class="card card-body">
                                      <div class="card">
                                          <div class="card-header">
                                              <h4 class="card-title">{{$k->kode}}. {{$k->nama}}</h4>
                                          </div>
                                          <div class="card-body">
                                              <div class="table-responsive">
                                                  <table class="table">
                                                      <thead class="text-primary">
                                                          <tr>
                                                              <th>#</th>
                                                              <th>{{$k->nama}}</th>
                                                              {{-- <th>Keterangan</th> --}}
                                                              <th>Nilai</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                          @foreach ($k->subkriterias as $sk)
                                                              <tr>
                                                                  <td>{{$loop->iteration}}</td>
                                                                  <td>{{$sk->kondisi}}</td>
                                                                  {{-- <td>Sangat Baik</td> --}}
                                                                  <td>{{$sk->nilai}}</td>
                                                              </tr>
                                                          @endforeach
                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              @endforeach
                          </div>
                          <div class="tab-pane" id="link5">
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead class="text-white bg-primary">
                                          <tr>
                                              <th>#</th>
                                              <th>Alternatif</th>
                                              <th>C1</th>
                                              <th>C2</th>
                                              <th>C3</th>
                                              <th>C4</th>
                                              <th>C5</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($pendampings as $p)
                                          <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td>{{$p->relasis[0]->pendamping->nama_depan.' '.$p->relasis[0]->pendamping->nama_belakang}}</td>
                                              <td>{{$p->relasis[0]->c1->nilai}}</td>
                                              <td>{{$p->relasis[0]->c2->nilai}}</td>
                                              <td>{{$p->relasis[0]->c3->nilai}}</td>
                                              <td>{{$p->relasis[0]->c4->nilai}}</td>
                                              <td>{{$p->relasis[0]->c5->nilai}}</td>
                                          </tr>
                                          @empty
                                              <tr>
                                                  <td colspan="8" class="text-center">Belum Ada Data</td>
                                              </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="link6">
                              <h5 class="text-primary">Rumus menghitung normalisasi matriks :</h5>
                              <img class="rounded mx-auto d-block" src="../img/normalisasi.png" alt="" style="width: 50%;">
                              <hr class="text-primary">
                              <h5 class="text-primary">Tabel Hasil Normalisasi :</h5>
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead class="text-white bg-primary">
                                          <tr>
                                              <th>#</th>
                                              <th>Alternatif</th>
                                              <th>C1</th>
                                              <th>C2</th>
                                              <th>C3</th>
                                              <th>C4</th>
                                              <th>C5</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          
                                          @forelse ($normalisasi as $p)
                                          <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td>{{$p['nama']}}</td>
                                              <td>{{$p['C1']}}</td>
                                              <td>{{$p['C2']}}</td>
                                              <td>{{$p['C3']}}</td>
                                              <td>{{$p['C4']}}</td>
                                              <td>{{$p['C5']}}</td>
                                          </tr>
                                          @empty
                                              <tr>
                                                  <td colspan="8" class="text-center">Belum Ada Data</td>
                                              </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="link7">
                              <h5 class="text-primary">Rumus menghitung Nilai Optimasi :</h5>
                              <img class="rounded mx-auto d-block" src="../img/optimasi1.png" alt="" style="width: 50%;">
                              <img class="rounded mx-auto d-block" src="../img/optimasi2.png" alt="" style="width: 50%;">
                              <hr class="text-primary">
                              <h5 class="text-primary">Tabel Normalisasi * Bobot :</h5>
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead class="text-white bg-primary">
                                          <tr>
                                              <th>#</th>
                                              <th>Alternatif</th>
                                              <th>C1</th>
                                              <th>C2</th>
                                              <th>C3</th>
                                              <th>C4</th>
                                              <th>C5</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($optimasi_l as $p)
                                          <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td>{{$p['nama']}}</td>
                                              <td>{{$p['C1']}}</td>
                                              <td>{{$p['C2']}}</td>
                                              <td>{{$p['C3']}}</td>
                                              <td>{{$p['C4']}}</td>
                                              <td>{{$p['C5']}}</td>
                                          </tr>
                                          @empty
                                              <tr>
                                                  <td colspan="8" class="text-center">Belum Ada Data</td>
                                              </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>
                              <hr class="text-primary">
                              <h5 class="text-primary">Tabel Hasil Optimasi :</h5>
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead class="text-white bg-primary">
                                          <tr>
                                              <th>#</th>
                                              <th>Alternatif</th>
                                              <th>C1</th>
                                              <th>C2</th>
                                              <th>C3</th>
                                              <th>C4</th>
                                              <th>C5</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($optimasi as $p)
                                          <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td>{{$p['nama']}}</td>
                                              <td>{{$p['C1']}}</td>
                                              <td>{{$p['C2']}}</td>
                                              <td>{{$p['C3']}}</td>
                                              <td>{{$p['C4']}}</td>
                                              <td>{{$p['C5']}}</td>
                                          </tr>
                                          @empty
                                              <tr>
                                                  <td colspan="8" class="text-center">Belum Ada Data</td>
                                              </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="link8">
                              <h5 class="text-primary">Tabel Perhitungan Yi :</h5>
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead class="text-white bg-primary">
                                          <tr>
                                              <th>#</th>
                                              <th>Alternatif</th>
                                              <th>Maximum C1 + C2 + C4 + C5</th>
                                              <th>Minimum C3</th>
                                              <th>Yi = Max - Min</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($Yi as $p)
                                          <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td>{{$p['nama']}}</td>
                                              <td>{{$p['MAX']}}</td>
                                              <td>{{$p['MIN']}}</td>
                                              <td>{{$p['Yi']}}</td>
                                          </tr>
                                          @empty
                                              <tr>
                                                  <td colspan="5" class="text-center">Belum Ada Data</td>
                                              </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>
                              <hr class="text-primary">
                              <h5 class="text-primary">Hasil Perankingan :</h5>
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead class="text-white bg-primary">
                                          <tr>
                                              <th>Alternatif</th>
                                              <th>Hasil</th>
                                              <th>Ranking</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($hasil as $p)
                                          <tr>
                                              <td>{{$p['nama']}}</td>
                                              <td>{{$p['Yi']}}</td>
                                              <td>{{$loop->iteration}}</td>
                                          </tr>
                                          @empty
                                              <tr>
                                                  <td colspan="3" class="text-center">Belum Ada Data</td>
                                              </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>                    
          </div>
      </div>
  </div>
</div>
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
{{-- <script>
  $(function () {
    $("#example1").DataTable({
      "columnDefs": [
        { "width": "10%", "targets": 1 }
      ],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script> --}}
@stop