<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Detail Calon Pendamping {{$pendamping->nama_depan}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body>
  <style>
    #header,
    #footer {
      position: fixed;
      left: 0;
        right: 0;
        color: #aaa;
        font-size: 0.9em;
    }
    #header {
      top: 0;
        border-bottom: 0.1pt solid #aaa;
    }
    #footer {
      bottom: 0;
      border-top: 0.1pt solid #aaa;
    }
    .page-number:before {
        text-align: center;
        float: right;
        color: black;
      content: "BNN Samarinda | Hal " counter(page);
    }

    .page-break {
        page-break-after: always;
    }

    h1 {
        font-size: 40px;
    }

    h2 {
        font-size: 30px;
    }

    p {
        font-size: 12px;
        line-height:80%;
    }

    td{
      font-size: 10px;
      text-align: center;
      vertical-align: middle;
    }

    th{
      text-align: center;
    }
    .table > tbody > tr > td {
     vertical-align: middle;
    }
    </style>
<div>
  <div id="footer">
    <div class="page-number"></div>
  </div>
  <img src="{{$base64}}" width="100%" height="140"/>
  <table class="table table-sm table-borderless" style="border: white;">
    <thead class="mb-0">
      <tr>
        <th style="text-align: center; vertical-align: middle; font-size: 25px;" class="text-underline"><u>Laporan</u></th>
    </tr>
    <tr>
      <th style="text-align: center; vertical-align: middle;">Detail Informasi Pendamping</th>
    </tr>
    </thead>
  </table>
    <table class="table table-sm table-bordered">
        <thead style="font-size:10px;" class="thead-light">
          <tr>
            <th colspan="3" style="text-align: center; vertical-align: middle; font-size: 15px;"><span>Biodata Calon pendamping</span></th>
          </tr>
          <tr>
            <td rowspan="10">
                  <img src="{{ url('public/pendamping/foto/'.$pendamping->foto) }}" class="mt-5 mb-0 px-0 py-0" alt="..." style="width: 100px; height: 120px;">
            </td>
            <th style="text-align: center; vertical-align: middle;">No. Ktp</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->no_ktp}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Nama</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->nama_depan.' '.$pendamping->nama_belakang}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
            @if ($pendamping->jenis_kelamin == 1)
              <td style="text-align: center; vertical-align: middle;">Pria</td>
            @else
              <td style="text-align: center; vertical-align: middle;">Wanita</td>
            @endif
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">No HP</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->no_hp}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Email</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->email}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Tanggal Lahir</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->tanggal_lahir}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Umur</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->usia}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Alamat</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->alamat}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Asal Universitas</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->universitas}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Jenjang Pendidikan</th>
            <td style="text-align: center; vertical-align: middle;">{{$pendamping->jenjang}}</td>
          </tr>
        </thead>
    </table>

    <table class="table table-sm table-bordered">
        <thead style="font-size:10px;" class="thead-light">
          <tr>
            <th colspan="6" style="text-align: center; vertical-align: middle; font-size: 15px;"><span>Detail Nilai</span></th>
          </tr>
          <tr>
            <th colspan="2">Kode</th>
            <th colspan="2">Kriteria</th>
            {{-- <th>Kondisi</th> --}}
            <th colspan="2">Nilai</th>
          </tr>
          <tr>
            <td colspan="2">C1</td>
            <td colspan="2">{{$pendamping->relasis[0]->c1->kriteria->nama}}</td>
            {{-- <td>{{$pendamping->relasis[0]->c1->kondisi}}</td> --}}
            <td colspan="2">{{$pendamping->relasis[0]->c1->nilai}}</td>
          </tr>
          <tr>
            <td colspan="2">C2</td>
            <td colspan="2">{{$pendamping->relasis[0]->c2->kriteria->nama}}</td>
            {{-- <td>{{$pendamping->relasis[0]->c2->kondisi}}</td> --}}
            <td colspan="2">{{$pendamping->relasis[0]->c2->nilai}}</td>
          </tr>
          <tr>
            <td colspan="2">C3</td>
            <td colspan="2">{{$pendamping->relasis[0]->c3->kriteria->nama}}</td>
            {{-- <td>{{$pendamping->usia}} Tahun</td> --}}
            <td colspan="2">{{$pendamping->relasis[0]->c3->nilai}}</td>
          </tr>
          <tr>
            <td colspan="2">C4</td>
            <td colspan="2">{{$pendamping->relasis[0]->c4->kriteria->nama}}</td>
            {{-- <td>{{$pendamping->relasis[0]->c4->kondisi}}</td> --}}
            <td colspan="2">{{$pendamping->relasis[0]->c4->nilai}}</td>
          </tr>
          <tr>
            <td colspan="2">C5</td>
            <td colspan="2">{{$pendamping->relasis[0]->c5->kriteria->nama}}</td>
            {{-- <td>{{$pendamping->relasis[0]->c5->kondisi}}</td> --}}
            <td colspan="2">{{$pendamping->relasis[0]->c5->nilai}}</td>
          </tr>

          <tr>
            <th colspan="6">Matriks Keputusan</th>
          </tr>
          <tr>
            <th>Kode</th>
            <td>C1</td>
            <td>C2</td>
            <td>C3</td>
            <td>C4</td>
            <td>C5</td>
          </tr>
          <tr>
            <th>Nilai</th>
            <td>{{$pendamping->relasis[0]->c1->nilai}}</td>
            <td>{{$pendamping->relasis[0]->c2->nilai}}</td>
            <td>{{$pendamping->relasis[0]->c3->nilai}}</td>
            <td>{{$pendamping->relasis[0]->c4->nilai}}</td>
            <td>{{$pendamping->relasis[0]->c5->nilai}}</td>
          </tr>

          <tr>
            <th colspan="6">Normalisasi Data</th>
          </tr>
          <tr>
            <th>Kode</th>
            <td>C1</td>
            <td>C2</td>
            <td>C3</td>
            <td>C4</td>
            <td>C5</td>
          </tr>
          <tr>
            <th>Nilai</th>
            <td>{{$normalisasi[0]['C1']}}</td>
            <td>{{$normalisasi[0]['C2']}}</td>
            <td>{{$normalisasi[0]['C3']}}</td>
            <td>{{$normalisasi[0]['C4']}}</td>
            <td>{{$normalisasi[0]['C5']}}</td>
          </tr>

          <tr>
            <th colspan="6">Optimasi Data</th>
          </tr>
          <tr>
            <th>Kode</th>
            <td>C1</td>
            <td>C2</td>
            <td>C3</td>
            <td>C4</td>
            <td>C5</td>
          </tr>
          <tr>
            <th>Nilai</th>
            <td>{{$optimasi[0]['C1']}}</td>
            <td>{{$optimasi[0]['C2']}}</td>
            <td>{{$optimasi[0]['C3']}}</td>
            <td>{{$optimasi[0]['C4']}}</td>
            <td>{{$optimasi[0]['C5']}}</td>
          </tr>

          <tr>
            <th colspan="6">Optimasi Data</th>
          </tr>
          <tr>
            <th>Kode</th>
            <td>C1</td>
            <td>C2</td>
            <td>C3</td>
            <td>C4</td>
            <td>C5</td>
          </tr>
          <tr>
            <th>Normalisasi * Bobot</th>
            <td>{{$optimasi_l[0]['C1']}}</td>
            <td>{{$optimasi_l[0]['C2']}}</td>
            <td>{{$optimasi_l[0]['C3']}}</td>
            <td>{{$optimasi_l[0]['C4']}}</td>
            <td>{{$optimasi_l[0]['C5']}}</td>
          </tr>
          <tr>
            <th>Optimasi</th>
            <td>{{$optimasi[0]['C1']}}</td>
            <td>{{$optimasi[0]['C2']}}</td>
            <td>{{$optimasi[0]['C3']}}</td>
            <td>{{$optimasi[0]['C4']}}</td>
            <td>{{$optimasi[0]['C5']}}</td>
          </tr>

          <tr>
            <th colspan="6">Perhitungan Yi</th>
          </tr>
          <tr>
            <th colspan="2">Maximum C1 + C2 + C4 + C5</th>
            <th colspan="2">Minimum C3</th>
            <th colspan="2">Yi = Max - Min</th>
        </tr>
          <tr>
            <td colspan="2">{{$Yi[0]['MAX']}}</td>
            <td colspan="2">{{$Yi[0]['MIN']}}</td>
            <td colspan="2">{{$Yi[0]['Yi']}}</td>
        </tr>

          <tr>
            <th colspan="2">Hasil</th>
            <td>{{$Yi[0]['Yi']}}</td>
            <th colspan="2">Peringkat</th>
            {{-- <th>Kondisi</th> --}}
            <td><strong>{{$rank}}</strong> / {{$jum}} </td>
          </tr>
        </tbody>
    </table>


        <table class="table table-borderless">
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td style="width: 150px;">Penanggung Jawab,</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td style="height: 20px; width: 150px;"></td>
            </tr>
            <tr>
              <td></td>
              <td ></td>
              <td style="width: 150px;"><u>{{$pendamping->nama_depan.' '.$pendamping->nama_belakang}}</u></td>
            </tr>
          </tbody>
        </table>

</div>
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>