<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Peringkat Calon Pendamping</title>
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
      <th style="text-align: center; vertical-align: middle;">Peringkat Calon Pendamping</th>
    </tr>
    </thead>
  </table>
    <table class="table table-sm table-bordered">
      <thead style="font-size:10px;" class="thead-light">
        <tr>
          <th>No</th>
          <th>Nama Calon Pendamping</th>
          <th>Informasi</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($pendampings as $calon)
          <tr>
            <td style="font-size: 20px;">{{$loop->iteration}}</td>
            <td>
              <div class="img-container">
                <img src="{{ url('public/pendamping/foto/'.$calon['foto']) }}" class="mt-2 mb-1" alt="..." style="width: 40px; height: 50px;">
            </div>
              <span>No Ktp : {{$calon['no_ktp']}}</span> <br>
              <span>Nama   : {{$calon['nama']}}</span>
            </td>
            <td>
              <span>No Hp  : {{$calon['no_hp']}}</span> <br>
              <span>Email  : {{$calon['email']}}</span> <br>
              <span>Alamat : {{$calon['alamat']}}</span>
            </td>
          @endforeach
      </tbody>
  </table>

    <div style="float: right; width: 28%;margin-top: 50px;">
        <table>
          <tr>
            <td>Penanggung Jawab,</td>
          </tr>
          <tr>
            <td style="height: 50px;"></td>
          </tr>
          <tr>
            <td><u>......................................</u></td>
          </tr>
        </table>
      </div>
</div>
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>