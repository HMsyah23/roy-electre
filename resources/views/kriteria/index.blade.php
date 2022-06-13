@extends('adminlte::page')

@section('title', 'Daftar Kriteria')

@section('content_header')
    <h1>Daftar Kriteria</h1>
@stop

@section('content')
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <div class="card direct-chat direct-chat-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Daftar Kriteria
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body mx-2 my-2 px-2 py-2">
                    @foreach ($kriterias as $k)
                        <p>
                            <button class="btn btn-primary btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#kriteria{{ $k->id }}" aria-expanded="false"
                                aria-controls="kriteria{{ $k->id }}">
                                {{ $k->kode }}. {{ $k->nama }} (Bobot = {{ $k->bobot }})
                            </button>
                        </p>
                        <div class="collapse" id="kriteria{{ $k->id }}">
                            <div class="card card-body">
                                <div class="card">
                                    @if ($k->kode == 'C1')
                                        <div class="card-header">
                                            <h4 class="card-title">{{ $k->kode }}. {{ $k->nama }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="text-primary">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ $k->nama }}</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Nilai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($k->subkriterias as $sk)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $sk->kondisi }}</td>
                                                                @if ($sk->tipe == 1)
                                                                  <td>Laki - Laki</td>
                                                                @else
                                                                  <td>Perempuan</td>
                                                                @endif
                                                                <td>{{ $sk->nilai }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-header">
                                            <h4 class="card-title">{{ $k->kode }}. {{ $k->nama }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="text-primary">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ $k->nama }}</th>
                                                            {{-- <th>Keterangan</th> --}}
                                                            <th>Nilai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($k->subkriterias as $sk)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $sk->kondisi }}</td>
                                                                {{-- <td>Sangat Baik</td> --}}
                                                                <td>{{ $sk->nilai }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- right col -->
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
