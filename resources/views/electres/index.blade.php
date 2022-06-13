@extends('adminlte::page')

@section('title', 'Perhitungan Electre')

@section('content_header')
    <h1>Halaman Perhitungan Electre</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">Langkah Perhitungan Electre</h4> 
                    <a href="{{ route('laporan.ranking') }}" class="ml-5 btn btn-primary btn-sm">
                            <i class="fas fa-male"></i> Laki - Laki
                        </a>
                        <a href="{{ route('laporan.ranking') }}" class="ml-5 btn btn-danger btn-sm">
                            <i class="fas fa-female"></i> Perempuan
                        </a>
                    <div class="card-tools">
                        {{-- <a href="{{ route('laporan.ranking') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-print"></i> Cetak Laporan
                        </a> --}}
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-12">
                            @if (session('sukses'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    {!! Session::get('sukses') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <ul class="nav nav-pills nav-pills-primary flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#link4" role="tablist">
                                        1. Nilai Kriteria
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link5" role="tablist">
                                        2. Daftar Alternatif
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
                                        5. Concordance & Disconcordance Index
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link9" role="tablist">
                                        6. Matrix Concordance & Disconcordance
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link10" role="tablist">
                                        7. Matriks Dominan Concordance dan Disconcordance
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link11" role="tablist">
                                        8. Perangkingan
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane active" id="link4">
                                    @foreach ($kriterias as $k)
                                        <p>
                                            <button class="btn btn-primary btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#kriteria{{ $k->id }}"
                                                aria-expanded="false" aria-controls="kriteria{{ $k->id }}">
                                                {{ $k->kode }}. {{ $k->nama }} (bobot = {{ $k->bobot }})
                                            </button>
                                        </p>
                                        <div class="collapse" id="kriteria{{ $k->id }}">
                                            <div class="card card-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">{{ $k->kode }}. {{ $k->nama }}
                                                        </h4>
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
                                                    <th>Tinggi Badan (C1)</th>
                                                    <th>BMI (C2)</th>
                                                    <th>Ketahanan Fisik (C3)</th>
                                                    <th>Skor Pelatihan Baris – ber Baris (C4)</th>
                                                    <th>Skor Tes Psikologi (C5)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($data as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p[0]['paskibraka']->nama_depan . ' ' . $p[0]['paskibraka']->nama_belakang }}
                                                        </td>
                                                        <td>{{ $p[0]['paskibraka']->tinggi_badan }}</td>
                                                        <td>{{ $p[0]['paskibraka']->bmi }}</td>
                                                        <td>{{ $p[2]['subkriteria']->kondisi }}</td>
                                                        <td>{{ $p[3]['subkriteria']->kondisi }}</td>
                                                        <td>{{ $p[4]['subkriteria']->kondisi }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

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
                                                @forelse ($data as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p[0]['paskibraka']->nama_depan . ' ' . $p[0]['paskibraka']->nama_belakang }}
                                                        </td>
                                                        <td>{{ $p[0]['subkriteria']->nilai }}</td>
                                                        <td>{{ $p[1]['subkriteria']->nilai }}</td>
                                                        <td>{{ $p[2]['subkriteria']->nilai }}</td>
                                                        <td>{{ $p[3]['subkriteria']->nilai }}</td>
                                                        <td>{{ $p[4]['subkriteria']->nilai }}</td>
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
                                    <img class="rounded mx-auto d-block" src="../img/normalisasi.png" alt=""
                                        style="width: 50%;">
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
                                                @forelse ($data as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p[0]['paskibraka']->nama_depan . ' ' . $p[0]['paskibraka']->nama_belakang }}
                                                        </td>
                                                        <td>{{ $p['n_c1'] }}</td>
                                                        <td>{{ $p['n_c2'] }}</td>
                                                        <td>{{ $p['n_c3'] }}</td>
                                                        <td>{{ $p['n_c4'] }}</td>
                                                        <td>{{ $p['n_c5'] }}</td>
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
                                    {{-- <h5 class="text-primary">Rumus menghitung Nilai Optimasi :</h5>
                                    <img class="rounded mx-auto d-block" src="../img/optimasi1.png" alt=""
                                        style="width: 50%;">
                                    <img class="rounded mx-auto d-block" src="../img/optimasi2.png" alt=""
                                        style="width: 50%;">
                                    <hr class="text-primary"> --}}
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
                                                @forelse ($data as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p[0]['paskibraka']->nama_depan . ' ' . $p[0]['paskibraka']->nama_belakang }}
                                                        </td>
                                                        <td>{{ $p['n_c1'] . ' * ' . $p[0]['subkriteria']['kriteria']['bobot'] }}
                                                        </td>
                                                        <td>{{ $p['n_c2'] . ' * ' . $p[1]['subkriteria']['kriteria']['bobot'] }}
                                                        </td>
                                                        <td>{{ $p['n_c3'] . ' * ' . $p[2]['subkriteria']['kriteria']['bobot'] }}
                                                        </td>
                                                        <td>{{ $p['n_c4'] . ' * ' . $p[3]['subkriteria']['kriteria']['bobot'] }}
                                                        </td>
                                                        <td>{{ $p['n_c5'] . ' * ' . $p[4]['subkriteria']['kriteria']['bobot'] }}
                                                        </td>
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
                                                @forelse ($data as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p[0]['paskibraka']->nama_depan . ' ' . $p[0]['paskibraka']->nama_belakang }}
                                                        </td>
                                                        <td>{{ $p['o_c1'] }}</td>
                                                        <td>{{ $p['o_c2'] }}</td>
                                                        <td>{{ $p['o_c3'] }}</td>
                                                        <td>{{ $p['o_c4'] }}</td>
                                                        <td>{{ $p['o_c5'] }}</td>
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
                                    <h5 class="text-primary">Tabel Concordance Index :</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-white bg-primary">
                                                <tr>
                                                    <th>C <sub>kl</sub></th>
                                                    <th>Himpunan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($a as $p)
                                                    @foreach ($p['concordanceIndex'] as $item => $value)
                                                        <tr>
                                                            <td> C <sub>{{ $i }},{{ $item + 1 }}</sub>
                                                            </td>
                                                            <td>{
                                                                @foreach ($value as $c)
                                                                    {{ $c }} ,
                                                                @endforeach
                                                                }
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @php $i++ @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <h5 class="text-primary">Tabel Disconcordane Index :</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-white bg-primary">
                                                <tr>
                                                    <th>C <sub>kl</sub></th>
                                                    <th>Himpunan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($a as $p)
                                                    @foreach ($p['disconcordanceIndex'] as $item => $value)
                                                        <tr>
                                                            <td> C <sub>{{ $i }},{{ $item + 1 }}</sub>
                                                            </td>
                                                            <td>{
                                                                @foreach ($value as $c)
                                                                    {{ $c }} ,
                                                                @endforeach
                                                                }
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @php $i++ @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="link9">
                                    <h5 class="text-primary">Tabel Matrix Concordance :</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-white bg-primary">
                                                <tr>
                                                    <th colspan="4">Matrik Concordance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($a as $p)
                                                    <tr>
                                                        @for ($i = 0; $i < 4; $i++)
                                                        <td>    
                                                        @if (isset($p['concordance'][$i]))
                                                                {{ $p['concordance'][$i] }}
                                                        @else
                                                        -
                                                        @endif
                                                        @endfor
                                                        </td>
                                                    </tr>
                                                    @php $i++ @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <h5 class="text-primary">Tabel Matrix Disconcordance :</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-white bg-primary">
                                                <tr>
                                                    <th colspan="4">Matrik Disconcordance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($a as $p)
                                                    <tr>
                                                        @for ($i = 0; $i < 4; $i++)
                                                        <td>    
                                                        @if (isset($p['disconcordance'][$i]))
                                                                {{ $p['disconcordance'][$i] }}
                                                        @else
                                                        -
                                                        @endif
                                                        @endfor
                                                        </td>
                                                    </tr>
                                                    @php $i++ @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="link10">
                                    <h5 class="text-primary">Tabel Matrix Concordance :</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-white bg-primary">
                                                <tr>
                                                    <th colspan="4">Matrik Dominan Concordance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($a as $p)
                                                    <tr>
                                                        @for ($i = 0; $i < 4; $i++)
                                                        <td>    
                                                        @if (isset($p['F'][$i]))
                                                                {{ $p['F'][$i] }}
                                                        @else
                                                        -
                                                        @endif
                                                        @endfor
                                                        </td>
                                                    </tr>
                                                    @php $i++ @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <h5 class="text-primary">Tabel Matrix Disconcordance :</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-white bg-primary">
                                                <tr>
                                                    <th colspan="4">Matrik Dominan Disconcordance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($a as $p)
                                                    <tr>
                                                        @for ($i = 0; $i < 4; $i++)
                                                        <td>    
                                                        @if (isset($p['G'][$i]))
                                                                {{ $p['G'][$i] }}
                                                        @else
                                                        -
                                                        @endif
                                                        @endfor
                                                        </td>
                                                    </tr>
                                                    @php $i++ @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <h5 class="text-primary">Tabel Agregat :</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-white bg-primary">
                                                <tr>
                                                    <th colspan="4">Agregat Dominan Matrik</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($a as $p)
                                                    <tr>
                                                        @for ($i = 0; $i < 4; $i++)
                                                        <td>    
                                                        @if (isset($p['E'][$i]))
                                                                {{ $p['E'][$i] }}
                                                        @else
                                                        -
                                                        @endif
                                                        @endfor
                                                        </td>
                                                    </tr>
                                                    @php $i++ @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="link11">
                                    <h5 class="text-primary">Tabel Agregat :</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-white bg-primary">
                                                <tr>
                                                    <th colspan="4">Agregat Dominan Matrik</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($a as $p)
                                                    <tr>
                                                        @for ($i = 0; $i < 4; $i++)
                                                        <td>    
                                                        @if (isset($p['E'][$i]))
                                                                {{ $p['E'][$i] }}
                                                        @else
                                                        -
                                                        @endif
                                                        </td>
                                                        @endfor
                                                        <td><strong>{{$p['nilai']}}</strong></td>
                                                    </tr>
                                                    @php $i++ @endphp
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
                                                    <th>#</th>
                                                    <th>Alternatif</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($b as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p['paskibraka'][0]['paskibraka']->nama_depan . ' ' . $p['paskibraka'][0]['paskibraka']->nama_belakang }}
                                                        </td>
                                                        <td>{{ $p['nilai'] }}
                                                        </td>
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
