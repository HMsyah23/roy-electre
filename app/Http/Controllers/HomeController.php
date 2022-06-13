<?php

namespace App\Http\Controllers;

use App\CalonPaskibraka, App\User, App\Kriteria, App\NilaiCalonPaskibraka;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $paskibrakaB = CalonPaskibraka::where('validasi', 0)->get();
        $paskibrakas = CalonPaskibraka::all();
        $users = User::all();
        $kriterias = Kriteria::all();
        return view('admin.index', compact('paskibrakas', 'paskibrakaB', 'users', 'kriterias'));
    }

    public function electres()
    {
        function normalisasi($variable, $f)
        {
            $item = 0;
            foreach ($variable as $p) {
                $pangkat = pow($p[$f]['subkriteria']['nilai'], 2);
                // dd($pangkat);
                $item = $item + $pangkat;
            }
            return sqrt($item);
        };

        $data = NilaiCalonPaskibraka::with(['subkriteria', 'subkriteria.kriteria', 'paskibraka'])->get()->groupBy('paskibraka.id')->values();
        $kriterias = Kriteria::with('subKriterias')->get();
        $n = $kriterias->count();

        // dump($data);
        $m = $data->count();
        // dd($m);
        $normalisasi = array();
        $optimasi = array();

        //Tahap Normalisasi & Optimasi Matriks
        foreach ($data as $key => $value) {
            $value['n_c1'] = round($value[0]['subkriteria']['nilai'] / normalisasi($data, 0), 3);
            $value['n_c2'] = round($value[1]['subkriteria']['nilai'] / normalisasi($data, 1), 3);
            $value['n_c3'] = round($value[2]['subkriteria']['nilai'] / normalisasi($data, 2), 3);
            $value['n_c4'] = round($value[3]['subkriteria']['nilai'] / normalisasi($data, 3), 3);
            $value['n_c5'] = round($value[4]['subkriteria']['nilai'] / normalisasi($data, 4), 3);
            $value['o_c1'] = $value['n_c1'] * $value[0]['subkriteria']['kriteria']['bobot'];
            $value['o_c2'] = $value['n_c2'] * $value[1]['subkriteria']['kriteria']['bobot'];
            $value['o_c3'] = $value['n_c3'] * $value[2]['subkriteria']['kriteria']['bobot'];
            $value['o_c4'] = $value['n_c4'] * $value[3]['subkriteria']['kriteria']['bobot'];
            $value['o_c5'] = $value['n_c5'] * $value[4]['subkriteria']['kriteria']['bobot'];
        }

        // Tahap Normalisasi
        foreach ($data as $key => $value) {
            $normalisasi[$key]['id'] = $value;
            $normalisasi[$key]['C1'] = $value['n_c1'];
            $normalisasi[$key]['C2'] = $value['n_c2'];
            $normalisasi[$key]['C3'] = $value['n_c3'];
            $normalisasi[$key]['C4'] = $value['n_c4'];
            $normalisasi[$key]['C5'] = $value['n_c5'];
        }

        // Tahap Optimasi
        foreach ($data as $key => $value) {
            $optimasi[$key]['id'] = $value;
            $optimasi[$key][1] = $value['o_c1'];
            $optimasi[$key][2] = $value['o_c2'];
            $optimasi[$key][3] = $value['o_c3'];
            $optimasi[$key][4] = $value['o_c4'];
            $optimasi[$key][5] = $value['o_c5'];
        }

        $V = $optimasi;

        $w = array();
        foreach ($kriterias as $key => $value) {
            $w[$key] = $value['bobot'];
        }

        /* mencari himpunan concordance index
                $n = jumlah kriteria
                $m = jumlah alternatif
                $V = matrik preferensi
                $c = himpunan concordance index
          */
        $c = array();
        $c_index = '';
        for ($k = 0; $k <= $m - 1; $k++) {
            if ($c_index != $k) {
                $c_index = $k;
                $c[$k] = array();
            }
            for ($l = 0; $l <= $m - 1; $l++) {
                if ($k != $l) {
                    for ($j = 1; $j <= $n; $j++) {
                        if (!isset($c[$k][$l])) $c[$k][$l] = array();
                        if ($V[$k][$j] >= $V[$l][$j]) {
                            array_push($c[$k][$l], $j);
                        }
                    }
                }
            }
        }

        /* mencari himpunan discordance index
              $n = jumlah kriteria
              $m = jumlah alternatif
              $V = matrik preferensi
              $c = himpunan discordance index
          */
        $d = array();
        $d_index = '';
        for ($k = 0; $k <= $m - 1; $k++) {
            if ($d_index != $k) {
                $d_index = $k;
                $d[$k] = array();
            }
            for ($l = 0; $l <= $m - 1; $l++) {
                if ($k != $l) {
                    for ($j = 1; $j <= $n; $j++) {
                        if (!isset($d[$k][$l])) $d[$k][$l] = array();
                        if ($V[$k][$j] < $V[$l][$j]) {
                            array_push($d[$k][$l], $j);
                        }
                    }
                }
            }
        }

        $C = array();
        $c_index = '';
        for ($k = 0; $k <= $m - 1; $k++) {
            if ($c_index != $k) {
                $c_index = $k;
                $C[$k] = array();
            }
            for ($l = 0; $l <= $m - 1; $l++) {
                if ($k != $l && count($c[$k][$l])) {
                    $f = 0;
                    foreach ($c[$k][$l] as $j) {
                        $C[$k][$l] = (isset($C[$k][$l]) ? $C[$k][$l] : 0) + $w[$j - 1];
                    }
                }
            }
        }

        $D = array();
        $d_index = '';
        for ($k = 0; $k <= $m - 1; $k++) {
            if ($d_index != $k) {
                $d_index = $k;
                $D[$k] = array();
            }
            for ($l = 0; $l <= $m - 1; $l++) {
                if ($k != $l) {
                    $max_d = 0;
                    $max_j = 0;
                    if (count($d[$k][$l])) {
                        $mx = array();
                        foreach ($d[$k][$l] as $j) {
                            if ($max_d < abs($V[$k][$j] - $V[$l][$j]))
                                $max_d = abs($V[$k][$j] - $V[$l][$j]);
                        }
                    }
                    $mx = array();
                    for ($j = 1; $j <= $n; $j++) {
                        if ($max_j < abs($V[$k][$j] - $V[$l][$j]))
                            $max_j = abs($V[$k][$j] - $V[$l][$j]);
                    }
                    if (($max_d == 0) && ($max_j == 0)) {
                        $D[$k][$l] = 0;
                    } else {
                        $D[$k][$l] = $max_d / $max_j;
                    }
                }
            }
        }

        // Threshold Concordance
        $sigma_c = 0;
        foreach ($C as $k => $cl) {
            foreach ($cl as $l => $value) {
                $sigma_c += $value;
            }
        }
        $threshold_c = $sigma_c / ($m * ($m - 1));

        // Threshold Discordance
        $sigma_d = 0;
        foreach ($D as $k => $dl) {
            foreach ($dl as $l => $value) {
                $sigma_d += $value;
            }
        }
        $threshold_d = $sigma_d / ($m * ($m - 1));

        // Dominan Matriks F
        $F = array();
        foreach ($C as $k => $cl) {
            $F[$k] = array();
            foreach ($cl as $l => $value) {
                $F[$k][$l] = ($value >= $threshold_c ? 1 : 0);
            }
        }

        // Dominan Matriks G 
        $G = array();
        foreach ($D as $k => $dl) {
            $G[$k] = array();
            foreach ($dl as $l => $value) {
                $G[$k][$l] = ($value >= $threshold_d ? 1 : 0);
            }
        }

        // Dominan Matriks F
        $E = array();
        foreach ($F as $k => $sl) {
            $E[$k] = array();
            foreach ($sl as $l => $value) {
                $E[$k][$l] = $F[$k][$l] * $G[$k][$l];
            }
        }

        $a = array();
        foreach ($E as $key => $value) {
            $a[$key]['paskibraka'] = $V[$key]['id'];
            $a[$key]['matriks']['C1'] = $normalisasi[$key]['C1'];
            $a[$key]['matriks']['C2'] = $normalisasi[$key]['C2'];
            $a[$key]['matriks']['C3'] = $normalisasi[$key]['C3'];
            $a[$key]['matriks']['C4'] = $normalisasi[$key]['C4'];
            $a[$key]['matriks']['C5'] = $normalisasi[$key]['C5'];
            $a[$key]['terbobot']['C1'] = $V[$key][1];
            $a[$key]['terbobot']['C2'] = $V[$key][2];
            $a[$key]['terbobot']['C3'] = $V[$key][3];
            $a[$key]['terbobot']['C4'] = $V[$key][4];
            $a[$key]['terbobot']['C5'] = $V[$key][5];
            $a[$key]['concordanceIndex'] = $c[$key];
            $a[$key]['disconcordanceIndex'] = $d[$key];
            $a[$key]['concordance'] = $C[$key];
            $a[$key]['disconcordance'] = $D[$key];
            $a[$key]['F'] = $F[$key];
            $a[$key]['G'] = $G[$key];
            $a[$key]['E'] = $E[$key];
            $a[$key]['nilai'] = array_sum($value);
        }

        $b = $a;
        usort($b, array($this, 'cmp'));

        // dd($a);
        return view('electres.index', compact('kriterias', 'data', 'normalisasi', 'optimasi', 'a', 'b'));
    }

    public function cmp($a, $b)
    {
        return strcmp($b['nilai'], $a['nilai']);
    }
}
